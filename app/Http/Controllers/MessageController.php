<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\Message;
use App\Events\MessageSent;
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

    public function index()
    {
        $api = new CommonModel();
        $result = $api->getAPI('lead/list/0'); // Ensure the API endpoint supports offset/limit if needed
    
        if ($result['status'] == "success") {
            $leaddata = collect($result['data']);
    
            // Get the current authenticated user
            $authUser = auth()->user();
    
            if ($authUser->hasRole('Super Admin')) {
                // If the user is a super admin, show all leads
                $filteredLeads = $leaddata;
            } else {
                // Otherwise, filter the leads based on the client assignment
                $filteredLeads = $leaddata->filter(function ($lead) use ($authUser) {
                    // Assuming the lead data contains a phone number field
                    $assignedUserId = ClientAssignment::where('phone_number', $lead['phone'])->value('user_id');
                    return $assignedUserId == $authUser->id;
                });
            }
    
            return view('messages.index', ['leaddata' => $filteredLeads]);
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


    //     public function getMessages($currentUserPhone)
    // {
    //     // Initialize Twilio client with your credentials
    //     $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

    //     // Format the phone number
    //     $currentUser = '+91' . $currentUserPhone;

    //     // Fetch messages where the user is the recipient
    //     $receivedMessages = $client->messages->read([
    //         'to' => $currentUser,
    //         'limit' => 20,
    //     ]);

    //     // Fetch messages where the user is the sender
    //     $sentMessages = $client->messages->read([
    //         'from' => $currentUser,
    //         'limit' => 20,
    //     ]);

    //     // Fetch call records where the user is the recipient or sender
    //     $receivedCalls = $client->calls->read([
    //         'to' => $currentUser,
    //         'limit' => 2,
    //     ]);

    //     $sentCalls = $client->calls->read([
    //         'from' => $currentUser,
    //         'limit' => 2,
    //     ]);


    //     // Combine both received and sent messages
    //     $messages = array_merge($receivedMessages, $sentMessages);
    //     $calls = array_merge($receivedCalls, $sentCalls);

    //     // print_r($calls); die;

    //     // Prepare an array to hold formatted messages
    //     $formattedMessages = [];

    //     foreach ($messages as $message) {
    //         // Determine if the user is the sender or recipient
    //         $direction = $message->from == $currentUser ? 'outgoing' : 'incoming';

    //         $formattedMessages[] = [
    //             'sid' => $message->sid,
    //             'from' => $message->from,
    //             'to' => $message->to,
    //             'body' => $message->body,
    //             'direction' => $direction,
    //             'formatted_created_at' => $message->dateSent ? $message->dateSent->format('Y-m-d H:i:s') : null,
    //         ];
    //     }
    //      // Format calls
    //      foreach ($calls as $call) {
    //         $direction = $call->from == $currentUser ? 'outgoing' : 'incoming';
    //         $duration = gmdate("H:i:s", $call->duration);

    //         $formattedMessages[] = [
    //             'type' => 'call',
    //             'sid' => $call->sid,
    //             'from' => $call->from,
    //             'to' => $call->to,
    //             'duration' => $duration,
    //             'recording_url' => $call->recordings ? $call->recordings->fetch()->uri : null,
    //             'direction' => $direction,
    //             'formatted_created_at' => $call->startTime ? $call->startTime->format('Y-m-d H:i:s') : null,
    //         ];
    //     }

    //     // Optionally, you can sort messages by date if needed
    //     usort($formattedMessages, function($a, $b) {
    //         return strtotime($b['formatted_created_at']) - strtotime($a['formatted_created_at']);
    //     });

    //     return response()->json($formattedMessages);
    // }

    // public function getMessages($currentUserPhone)
    // {
    //     ini_set('max_execution_time', 300);
    //     // Initialize Twilio client with your credentials
    //     $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

    //     // Format the phone number
    //     $currentUser = '+91' . $currentUserPhone;

    //     // Fetch a limited number of received and sent messages
    //     $receivedMessages = $client->messages->read([
    //         'to' => $currentUser,
    //         'limit' => 5,  // Limit to 5 messages
    //     ]);

    //     $sentMessages = $client->messages->read([
    //         'from' => $currentUser,
    //         'limit' => 5,  // Limit to 5 messages
    //     ]);

    //     // Fetch a limited number of received and sent calls
    //     $receivedCalls = $client->calls->read([
    //         'to' => $currentUser,
    //         'limit' => 2,  // Limit to 5 calls
    //     ]);

    //     $sentCalls = $client->calls->read([
    //         'from' => $currentUser,
    //         'limit' => 2,  // Limit to 5 calls
    //     ]);

    //     // Combine both received and sent messages
    //     $messages = array_merge($receivedMessages, $sentMessages);
    //     $calls = array_merge($receivedCalls, $sentCalls);

    //     // Prepare an array to hold formatted messages
    //     $formattedMessages = [];

    //     // Format messages with only the necessary data
    //     foreach ($messages as $message) {
    //         $direction = $message->from == $currentUser ? 'outgoing' : 'incoming';

    //         $formattedMessages[] = [
    //             'type' => 'message',
    //             'from' => $message->from,
    //             'to' => $message->to,
    //             'body' => $message->body,
    //             'direction' => $direction,
    //             'created_at' => $message->dateSent ? $message->dateSent->format('Y-m-d H:i:s') : null,
    //         ];
    //     }

    //     $formattedCalls = [];
    //     $page = 0;
    //     $limit = 2; // Number of records per page

    //     try {
    //         do {
    //             $calls = $client->calls->read([
    //                 'to' => $currentUser,
    //                 'limit' => $limit,
    //                 'page' => $page,
    //             ]);

    //             foreach ($calls as $call) {
    //                 $direction = $call->from == $currentUser ? 'outgoing' : 'incoming';
    //                 $duration = isset($call->duration) ? gmdate("H:i:s", (int)$call->duration) : '00:00:00';

    //                 $recordings = $client->recordings->read([
    //                     'callSid' => $call->sid,
    //                     'limit' => 1,
    //                 ]);

    //                 $recordingUrl = null;
    //                 if (!empty($recordings)) {
    //                     $recording = $recordings[0];
    //                     $recordingUrl = 'https://api.twilio.com' . $recording->uri . '.mp3?Download=true';
    //                 }

    //                 $formattedCalls[] = [
    //                     'type' => 'call',
    //                     'from' => $call->from,
    //                     'to' => $call->to,
    //                     'duration' => $duration,
    //                     'recording_url' => $recordingUrl,
    //                     'direction' => $direction,
    //                     'created_at' => $call->dateCreated ? $call->dateCreated->format('Y-m-d H:i:s') : null,
    //                 ];
    //             }

    //             $page++;
    //             // Exit the loop if no more calls are returned
    //             if (count($calls) < $limit) {
    //                 break;
    //             }

    //         } while (true);

    //     } catch (\Exception $e) {
    //         // Handle exception and log errors
    //         Log::error('Error fetching calls: ' . $e->getMessage());
    //         dd('An error occurred: ' . $e->getMessage());
    //     }

    //     // Output the formatted calls
    //     dd($formattedCalls);


    //     // Sort messages and calls by date and time
    //     usort($formattedMessages, function ($a, $b) {
    //         return strtotime($b['created_at']) - strtotime($a['created_at']);
    //     });

    //     // Return the limited formatted data as JSON
    //     return response()->json($formattedMessages);
    // }

    public function getMessages($currentUserPhone, Request $request)
    {
        ini_set('max_execution_time', 300);

        // Initialize Twilio client with your credentials
        $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        // Format the phone number
        $currentUser = '+91' . $currentUserPhone;

        // Get the current page and limit from the request
        $page = $request->input('page', 1);
        $limit = 10;

        // Fetch messages (received and sent)
        $receivedMessages = $client->messages->read([
            'to' => $currentUser,
        ], $limit, ($page - 1) * $limit);

        $sentMessages = $client->messages->read([
            'from' => $currentUser,
        ], $limit, ($page - 1) * $limit);

        // Combine received and sent messages
        $messages = array_merge($receivedMessages, $sentMessages);

        // Fetch calls (received and sent)
        $receivedCalls = $client->calls->read([
            'to' => $currentUser,
        ], $limit, ($page - 1) * $limit);

        $sentCalls = $client->calls->read([
            'from' => $currentUser,
        ], $limit, ($page - 1) * $limit);

        // Combine received and sent calls
        $calls = array_merge($receivedCalls, $sentCalls);

        // Prepare an array to hold formatted messages and calls
        $formattedData = [];

        // Format messages
        foreach ($messages as $message) {
            $direction = $message->from == $currentUser ? 'outgoing' : 'incoming';

            $formattedData[] = [
                'type' => 'message',
                'from' => $message->from,
                'to' => $message->to,
                'body' => $message->body,
                'direction' => $direction,
                'created_at' => $message->dateSent ? $message->dateSent->format('Y-m-d H:i:s') : null,
            ];
        }

        // Format calls
        foreach ($calls as $call) {
            $direction = $call->from == $currentUser ? 'outgoing' : 'incoming';
            $duration = isset($call->duration) ? gmdate("H:i:s", (int)$call->duration) : '00:00:00';

            $recordings = $client->recordings->read([
                'callSid' => $call->sid,
                'limit' => 1,
            ]);

            $recordingUrl = null;
            if (!empty($recordings)) {
                $recording = $recordings[0];
                $recordingUrl = 'https://api.twilio.com' . $recording->uri . '.mp3?Download=true';
            }

            $formattedData[] = [
                'type' => 'call',
                'from' => $call->from,
                'to' => $call->to,
                'duration' => $duration,
                'recording_url' => $recordingUrl,
                'direction' => $direction,
                'created_at' => $call->dateCreated ? $call->dateCreated->format('Y-m-d H:i:s') : null,
            ];
        }

        // Sort combined data by date and time
        usort($formattedData, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        // Paginate the sorted data manually
        $offset = ($page - 1) * $limit;
        $paginatedData = array_slice($formattedData, $offset, $limit);

        // Check if there is more data to load
        $hasMore = count($formattedData) > ($offset + $limit);

        return response()->json([
            'data' => $paginatedData,
            'current_page' => $page,
            'has_more' => $hasMore,
        ]);
    }


    public function receiveMessage(Request $request)
    {

        dd($request->all());
        $message = new Message();
        $message->body = $request->input('Body');
        $message->from = $request->input('From');
        $message->to = $request->input('To');
        $message->direction = 'incoming';
        $message->save();

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'success']);
    }
    // public function sendPusher()
    // {
    //     event(new MyEvent('hello world'));
    // }

    // public function sendMessage(Request $request)
    // {
    //     dd($request->all());
    //     $request->merge(['to' => '+91' . $request->input('to')]);

    //     // Validate the request inputs
    //     $validated = $request->validate([
    //         'to' => 'required|string',
    //         'body' => 'required|string'
    //     ]);

    //     try {
    //         $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

    //         $client->messages->create(
    //             $request->input('to'),
    //             [
    //                 'messagingServiceSid' => env('TWILIO_MESSAGING_SERVICE_SID'),
    //                 'body' => $request->input('body')
    //             ]
    //         );

    //         $message = new Message();
    //         $message->body = $request->input('body');
    //         $message->from = env('TWILIO_PHONE_NUMBER');
    //         $message->to = $request->input('to');
    //         $message->direction = 'outgoing';
    //         $message->save();

    //         broadcast(new MessageSent($message))->toOthers();

    //         // Return a success response
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Message sent successfully!',
    //             'data' => $message
    //         ], 200);
    //     } catch (\Exception $e) {
    //         // Handle any errors
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to send message!',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function sendMessage(Request $request)
    {
        // Merge country code with the phone number
        $request->merge(['to' => '+91' . $request->input('to')]);

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
