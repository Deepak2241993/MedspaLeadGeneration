<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\Message;
use App\Models\TwilioCall;
use App\Events\MessageSent;
use App\Events\MessageReceived;
use App\Models\CommonModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use App\Models\ClientAssignment;


class MessageController extends Controller
{
    protected $client;

    public function __construct()
    {
        // role & permission
        $this->middleware('permission:message_view', ['only' => ['index']]);
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    // public function index()
    // {
    //     $api = new CommonModel();
    //     $result = $api->getAPI('lead/list/0'); // Ensure the API endpoint supports offset/limit if needed
    
    //     if ($result['status'] == "success") {
    //         $leaddata = collect($result['data']);
    
    //         // Get the current authenticated user
    //         $authUser = auth()->user();
    
    //         if ($authUser->hasRole('Super Admin')) {
    //             // If the user is a Super Admin, show all leads
    //             $filteredLeads = $leaddata;
    //         } else {
    //             // Otherwise, filter the leads based on the client assignment
    //             $filteredLeads = $leaddata->filter(function ($lead) use ($authUser) {
    //                 // Assuming the lead data contains a phone number field
    //                 $assignedUserId = ClientAssignment::where('phone_number', $lead['phone'])->value('user_id');
            
    //                 // Show the lead if it is assigned to the current user or if it is not assigned to anyone
    //                 return $assignedUserId == $authUser->id || is_null($assignedUserId);
    //             });
    //         }
    
    //         return view('messages.index', ['leaddata' => $filteredLeads]);
    //     } else {
    //         return view('messages.index', ['leaddata' => collect([])]);
    //     }
    // }
     public function index()
    {
        $api = new CommonModel();
        $result = $api->getAPI('lead/list/0'); 
    
        if ($result['status'] == "success") {
            $leaddata = collect($result['data']);
            $authUser = auth()->user();
        
            if ($authUser->hasRole('Super Admin')) {
                $filteredLeads = $leaddata;
            } else {
                $filteredLeads = $leaddata->filter(function ($lead) use ($authUser) {
                    $assignedUserId = ClientAssignment::where('phone_number', $lead['phone'])->value('user_id');
                    return $assignedUserId == $authUser->id || is_null($assignedUserId);
                });
            }
            $uniqueLeads = [];
            $seen = [];
    
            foreach ($filteredLeads as $lead) {
                $uniqueKey = $lead['country_code'] . $lead['phone'];
                if (!isset($seen[$uniqueKey])) {
                    $uniqueLeads[] = $lead;
                    $seen[$uniqueKey] = true;
                }
            }
            return view('messages.index', ['leaddata' => collect($uniqueLeads)]);
        } else {
            return view('messages.index', ['leaddata' => collect([])]);
        }
    }
    
    
    public function loadMoreLeads(Request $request)
    {
        $page = $request->get('page', 1);
        $api = new CommonModel();
        $result = $api->getAPI("lead/list/{$page}"); // Adjust the API call if needed to support paging

        if ($result['status'] == "success") {
            return response()->json(['leads' => $result['data']]);
        } else {
            return response()->json(['leads' => []]);
        }
    }

    
    public function getMessages($currentUserPhone, Request $request)
    {
        // Sanitize and validate the phone number
        $currentUserPhone = preg_replace('/[^\d+]/', '', $currentUserPhone); // Ensure valid phone format

        // dd($currentUserPhone);
        $page = (int) $request->input('page', 1);
        $limit = 200; // Increased to 10 for a more reasonable merge

        // Fetch calls from the twilio_calls table
        $callsQuery = TwilioCall::where('from', $currentUserPhone)
            ->orWhere('to', $currentUserPhone)
            ->orderBy('created_at', 'desc');

        // Fetch messages from the twilio_messages table
        $messagesQuery = Message::where('from', $currentUserPhone)
            ->orWhere('to', $currentUserPhone)
            ->orderBy('created_at', 'desc');

        // Get the data for the current page and limit
        $calls = $callsQuery->skip(($page - 1) * $limit)->take($limit)->get()->toArray();
        $messages = $messagesQuery->skip(($page - 1) * $limit)->take($limit)->get()->toArray();

        // Merge the arrays and sort by created_at
        $combinedDataArray = array_merge($calls, $messages);

        usort($combinedDataArray, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        // Check if there are more pages
        $hasMorePages = count($combinedDataArray) > $limit;

        // Slice the array to respect pagination
        $paginatedData = array_slice($combinedDataArray, 0, $limit);

        // Log the total count and the fetched data (for debugging)
        Log::info("Total combined records found: " . count($combinedDataArray));
        Log::info("Combined records fetched on page $page: " . json_encode($paginatedData));

        return response()->json([
            'data' => $paginatedData,
            'current_page' => $page,
            'has_more' => $hasMorePages,
        ]);
    }

    public function receiveMessage(Request $request)
    {
        Log::info('Received message:', $request->all());

        // Check if required parameters are present
        $messageBody = $request->input('Body');
        $from = $request->input('From');
        $to = $request->input('To');
        $user_id = $request->input('user_id');

        if (!$messageBody || !$from || !$to) {
            Log::error('Missing required parameters');
            return response()->json(['status' => 'Error', 'message' => 'Missing required parameters'], 400);
        }

        // Save message to the database
        $message = new Message();
        $message->type = 'message';
        $message->body = $messageBody;
        $message->from = $from;
        $message->to = $to;
        $message->direction = 'incoming';
        $message->user_id = $user_id;
        $message->save();

        // Broadcast event
        broadcast(new MessageReceived($message, $to))->toOthers();

        return response()->json(['status' => 'Message received']);
    }
    
    
    public function sendMessage(Request $request)
    {
        // Validate the request inputs
        $validated = $request->validate([
            'to' => 'required|string',
            'body' => 'required|string'
        ]);

        try {
            $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

            $client->messages->create(
                $request->input('to'),
                [
                    'messagingServiceSid' => env('TWILIO_MESSAGING_SERVICE_SID'),
                    'body' => $request->input('body')
                ]
            );

            // Check if the client is already assigned to a user
            $user = auth()->user(); // Get the currently authenticated user
            $clientPhoneNumber = $request->input('to');

            $clientAssignment = ClientAssignment::firstOrCreate(
                ['phone_number' => $clientPhoneNumber], // Check if phone number exists
                ['user_id' => $user->id] // Assign to the current user if not found
            );

            // Save the message to the database
            $message = new Message();
            $message->type = 'message';
            $message->body = $request->input('body');
            $message->from = env('TWILIO_PHONE_NUMBER');
            $message->to = $clientPhoneNumber;
            $message->direction = 'outgoing';
            $message->user_id = $user->id; // Associate the message with the user
            $message->save();

            broadcast(new MessageSent($message))->toOthers();

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!',
                'data' => $message
            ], 200);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
