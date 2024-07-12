<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\CommonModel;

class MessageController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function index()
    {
        $api = new CommonModel();
        $result = $api->getAPI('lead/list/0');

        if ($result['status'] == "success") {
            $leaddata = collect($result['data']);
            $messages = Message::orderBy('created_at', 'asc')->get();
            return view('messages.index', ['messages' => $messages, 'leaddata' => $leaddata]);
        } else {
            // Handle the case where the API request is not successful
            // You can redirect, return an error view, or provide a fallback
            return view('messages.index', ['messages' => [], 'leaddata' => collect([])]);
        }
        // $messages = Message::orderBy('created_at', 'asc')->get();
        // return view('messages.index', compact('messages'));
    }
    public function getMessages($currentUserPhone)
{
    // Initialize Twilio client with your credentials
    $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

    // Format the phone number
    $currentUser = '+91' . $currentUserPhone;

    // Fetch messages where the user is the recipient
    $receivedMessages = $client->messages->read([
        'to' => $currentUser,
        'limit' => 20,
    ]);

    // Fetch messages where the user is the sender
    $sentMessages = $client->messages->read([
        'from' => $currentUser,
        'limit' => 20,
    ]);

    // Fetch call records where the user is the recipient or sender
    $receivedCalls = $client->calls->read([
        'to' => $currentUser,
        'limit' => 20,
    ]);

    $sentCalls = $client->calls->read([
        'from' => $currentUser,
        'limit' => 20,
    ]);


    // Combine both received and sent messages
    $messages = array_merge($receivedMessages, $sentMessages);
    $calls = array_merge($receivedCalls, $sentCalls);

    dd($calls);

    // Prepare an array to hold formatted messages
    $formattedMessages = [];

    foreach ($messages as $message) {
        // Determine if the user is the sender or recipient
        $direction = $message->from == $currentUser ? 'outgoing' : 'incoming';

        $formattedMessages[] = [
            'sid' => $message->sid,
            'from' => $message->from,
            'to' => $message->to,
            'body' => $message->body,
            'direction' => $direction,
            'formatted_created_at' => $message->dateSent ? $message->dateSent->format('Y-m-d H:i:s') : null,
        ];
    }

    // Optionally, you can sort messages by date if needed
    usort($formattedMessages, function($a, $b) {
        return strtotime($b['formatted_created_at']) - strtotime($a['formatted_created_at']);
    });

    return response()->json($formattedMessages);
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
    public function sendPusher()
    {
        event(new MyEvent('hello world'));
    }

    public function sendMessage(Request $request)
    {
        // dd($request);
        $request->merge(['to' => '+1' . $request->input('to')]);

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

            $message = new Message();
            $message->body = $request->input('body');
            $message->from = env('TWILIO_PHONE_NUMBER');
            $message->to = $request->input('to');
            $message->direction = 'outgoing';
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
