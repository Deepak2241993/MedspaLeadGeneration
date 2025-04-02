<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;
use Twilio\TwiML\VoiceResponse;
use App\Models\TwilioCall;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
use App\Events\CallEnded;
use Illuminate\Support\Facades\Validator;



class CallController extends Controller
{

    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        // permision 
        // $this->middleware('permission:call_create',['only' => ['outboundCall','userGather','endCall','connectClient']]);
        // role & permisssion
        // $this->middleware('permission:call_create',['only' => ['outboundCall']]);

    }
    public function outboundCall(Request $request)
    {
        $users = Auth::user();
        // dd($users);
        $twilio_number = env('TWILIO_PHONE_NUMBER');
        $userPhoneNumber = $users->country_code . $users->phone; // The phone number of the user to connect first
        $clientPhoneNumber = $request->input('phone'); // The phone number of the client to connect after the user

        try {
            Log::info('Initiating call:', [
                'twilio_number' => $twilio_number,
                'userPhoneNumber' => $userPhoneNumber,
                'clientPhoneNumber' => $clientPhoneNumber,
            ]);

            // Call the user first
            $call = $this->twilio->calls->create(
                $userPhoneNumber, // To
                $twilio_number, // From
                [
                    'url' => route('twilio.user-gather', ['client_phone' => $clientPhoneNumber]),
                    'method' => 'POST',
                    'record' => 'true',
                    'statusCallback' => route('twilio.call-status'),
                    'recordingStatusCallback' => route('twilio.recording-status', ['from' => $userPhoneNumber, 'to' => $clientPhoneNumber]),
                    'statusCallbackMethod' => 'POST',
                    'recordingStatusCallbackMethod' => 'POST' // Method to send recording status updates
                ]
            );

            // Log the Call SID for debugging
            Log::info('Call initiated with SID: ' . $call->sid);



            // Store the Call SID and other details in the session
            session([
                'twilio_call_sid' => $call->sid
            ]);

            // Log the session data to confirm values are set
            Log::info('Session data after call initiation:', session()->all());

            return response()->json(['status' => 'Call initiated', 'call_sid' => $call->sid]);
        } catch (\Exception $e) {
            Log::error('Error initiating call: ' . $e->getMessage());

            return response()->json(['status' => 'Error', 'message' => $e->getMessage()], 500);
        }
    }

    public function userGather(Request $request)
    {
        $clientPhoneNumber = $request->query('client_phone');

        $response = new VoiceResponse();
        $dial = $response->dial();
        $dial->number($clientPhoneNumber);

        // Log the Call SID for debugging
        Log::info('Connecting to client phone number: ' . $clientPhoneNumber);

        return response($response, 200)->header('Content-Type', 'text/xml');
    }

    public function endCall()
    {
        try {
            // Retrieve the Call SID from the session
            $callSid = session('twilio_call_sid');

            // Check if the Call SID is available
            if (!$callSid) {
                return response()->json(['success' => false, 'message' => 'No active call found.']);
            }

            // End the call using the Twilio client
            $this->twilio->calls($callSid)->update(['status' => 'completed']);
            

            // Clear the Call SID and other relevant session data
            session()->forget('twilio_call_sid');
            session()->forget('twilio_call_from');
            session()->forget('twilio_call_to');

            return response()->json(['success' => true, 'message' => 'Call ended successfully.']);
        } catch (\Exception $e) {
            // Log the exception message for debugging
            Log::error('Error ending call: ' . $e->getMessage());
            
            return response()->json(['success' => false, 'message' => 'Failed to end call: ' . $e->getMessage()]);
        }
    }
    // Handle call status updates from Twilio
   public function handleCallStatus(Request $request)
{
    // Log the incoming request
    Log::info('Incoming request from Twilio:', $request->all());

    // Validate incoming request
    $validator = Validator::make($request->all(), [
        'CallSid' => 'required|string',
        'CallStatus' => 'required|string',
    ]);

    if ($validator->fails()) {
        Log::error('Validation failed: ', $validator->errors()->toArray());
        return response()->json(['error' => 'Invalid request', 'messages' => $validator->errors()], 400);
    }

    // Proceed with your logic based on CallStatus
    $callSid = $request->input('CallSid');
    $callStatus = $request->input('CallStatus');

    // Handle call status
    switch ($callStatus) {
        case 'completed':
            Log::info("Dispatching CallEnded event for Call SID: {$callSid}");
            // Broadcast the CallEnded event
            event(new CallEnded($callSid)); // Use event() for broadcasting
            break;

        case 'canceled':
            Log::info("Call with SID {$callSid} was canceled.");
            break;

        // Handle additional call statuses if needed
        default:
            Log::info("Unhandled Call Status: {$callStatus} for Call SID: {$callSid}");
            break;
    }

    // Respond with a status indicating the request was received
    return response()->json(['status' => 'received']);
}




    public function connectClient(Request $request)
    {
        $clientPhoneNumber = $request->input('client_phone');

        $response = new \Twilio\TwiML\VoiceResponse();
        $dial = $response->dial('', ['record' => 'record-from-answer']); // Record both sides of the call
        $dial->number($clientPhoneNumber);

        return response($response, 200)->header('Content-Type', 'text/xml');
    }


    public function handleRecordingStatus(Request $request)
    {
        Log::info('Recording status callback received.', $request->all());

        $from = $request->input('from', 'unknown'); // Retrieve from query parameters
        $to = $request->input('to', 'unknown');

        Log::info('Session data:', ['from' => $from, 'to' => $to]);

        // Get the recording details from the request
        $recordingSid = $request->input('RecordingSid');
        $recordingUrl = $request->input('RecordingUrl');
        $callSid = $request->input('CallSid');
        $direction = $request->input('Direction', 'outgoing'); // Default to 'outbound-api' if not provided
        $duration = $request->input('RecordingDuration', 0); // Default to 0 if not provided

        // Save recording details to the database
        try {
            TwilioCall::create([
                'sid' => $recordingSid,
                'type' => 'call',
                'from' => $from,
                'to' => $to,
                'duration' => $duration,
                'recording_url' => $recordingUrl,
                'direction' => $direction,
                'user_id' => null, // Assign a user ID if applicable
            ]);

            Log::info("Recording details saved for SID: {$recordingSid}");
            session()->flash('recording_success', 'Call recording successfully saved.');
        } catch (\Exception $e) {
            Log::error("Error saving recording details: " . $e->getMessage());
        }

        // Define the local path to save the recording
        $localFilePath = storage_path("app/call_recordings/{$recordingSid}.mp3");

        // Log the path where the file will be saved
        Log::info("Saving recording to: {$localFilePath}");

        // Basic Authentication credentials
        $username = env('TWILIO_SID');
        $password = env('TWILIO_AUTH_TOKEN');

        // Create a context with Basic Authentication
        $context = stream_context_create([
            'http' => [
                'header' => "Authorization: Basic " . base64_encode("{$username}:{$password}"),
            ],
        ]);

        // Download the recording file
        try {
            $response = file_get_contents($recordingUrl, false, $context);

            if ($response !== false) {
                // Save the recording to the local storage
                file_put_contents($localFilePath, $response);
                Log::info("Recording saved to {$localFilePath}");
            } else {
                Log::error("Failed to download recording from URL: {$recordingUrl}");
            }
        } catch (\Exception $e) {
            Log::error("Error downloading recording: " . $e->getMessage());
        }

        return response()->json(['status' => 'Recording downloaded']);
    }
    public function handleIncomingCall(Request $request)
    {
        Log::info('Incoming call received.');
        Log::info($request->all());
        
        // Store call details
        $callSid = $request->input('CallSid');
        $from = $request->input('From');
        $to = $request->input('To');
    
        // Save call details to the database
        TwilioCall::create([
            'sid' => $callSid,
            'type' => 'call',
            'from' => $from,
            'to' => $to,
        ]);
        
        $response = new VoiceResponse();

        // Gathering input
        $gather = $response->gather([
            'numDigits' => 1,
            'action' => url('/twilio/handle-gather'),  // Prefer route over URL
            'method' => 'POST'
        ]);
        
        // Play options to the caller
        $gather->say('Thank you for calling! Press 1 to connect to the sales team, or press 2 to connect to the accounts team.');
        
        // Add pause and repeat the options
        $response->pause(['length' => 4]);
        $gather->say('Thank you for calling! Press 1 to connect to the sales team, or press 2 to connect to the accounts team.');
        
        // Log the TwiML response for debugging
        Log::info('TwiML Response generated: ' . $response);
        
        return response($response, 200)->header('Content-Type', 'text/xml');
    }
    public function handleGather(Request $request)
    {
        Log::info("Handling gather request.");
        $digits = $request->input('Digits');

        $response = new VoiceResponse();

        if ($digits == 1) {
            Log::info("Caller pressed 1. Connecting to the sales team.");

            // Fetch active sales numbers from the database
            $salesNumbers = Role::pluck('phone_numbers')->toArray();

            if (empty($salesNumbers)) {
                // If no active sales numbers, handle accordingly
                Log::warning("No active sales numbers found.");
                $response->say("Sorry, there are no available sales representatives at the moment.");
                return response($response, 200)->header('Content-Type', 'text/xml');
            }

            // Create a Dial verb to connect to sales team with action for busy scenario
            $dial = $response->dial(null, [
                'record' => 'record-from-ringing-dual',
                'recordingStatusCallback' => url('/twilio/handle-recording-status'),
                'recordingStatusCallbackMethod' => 'POST',
                'timeout' => 15 // 15 seconds timeout before checking the next number
            ]);

            // Add each sales number as a Number element within the Dial verb
            foreach ($salesNumbers as $number) {
                $dial->number($number, [
                    'statusCallback' => url('/twilio/handle-status'),
                    'statusCallbackEvent' => 'completed',
                    'statusCallbackMethod' => 'POST',
                    'action' => url('/twilio/handle-busy'), // Action URL to handle busy status
                ]);
            }

        } elseif ($digits == 2) {
            Log::info("Caller pressed 2. Connecting to the accounts team.");

            // Fetch active account team number(s)
            $accountTeamNumbers = Role::pluck('phone_numbers')->toArray();

            if (empty($accountTeamNumbers)) {
                // If no active account team numbers, handle accordingly
                Log::warning("No active account team numbers found.");
                $response->say("Sorry, there are no available account representatives at the moment.");
                return response($response, 200)->header('Content-Type', 'text/xml');
            }

            // Assuming you want to connect to the first available account team number
            $response->dial($accountTeamNumbers[0], [
                'record' => 'record-from-ringing-dual',
                'recordingStatusCallback' => url('/twilio/handle-recording-status'),
                'recordingStatusCallbackMethod' => 'POST',
                'action' => url('/twilio/handle-busy') // Action URL to handle busy status
            ]);

        } else {
            // Invalid input, repeat the options
            $response->say("Invalid option. Please try again.");
            $response->redirect(route('twilio.inbound-call'));
        }

        return response($response, 200)->header('Content-Type', 'text/xml');
    }
    public function handleBusy(Request $request)
    {
        Log::info("All numbers are busy, handling busy state.");

        // Create a new VoiceResponse
        $response = new VoiceResponse();

        // Queue the caller, or tell them to wait
        $queueName = 'sales_team_queue'; // Use a unique queue name for your team
        $response->enqueue($queueName, [
            'action' => url('/twilio/handle-waiting'), // After a certain time, go to handle waiting
            'waitUrl' => url('/twilio/handle-waiting'), // URL for hold music or wait time
        ]);

        // Return the response
        return response($response, 200)->header('Content-Type', 'text/xml');
    }
    public function handleWaiting(Request $request)
    {
        Log::info("Caller is on hold, playing waiting message.");

        $response = new VoiceResponse();

        // Play a message informing the caller to wait
        $response->say("All sales representatives are currently busy. Please hold for a moment while we connect you.");

        // Optionally, you can loop music or messages until a representative becomes available.
        $response->play('http://yourdomain.com/hold-music.mp3');

        return response($response, 200)->header('Content-Type', 'text/xml');
    }


    public function incomingHandleRecordingStatus(Request $request)
    {
        Log::info("Handling recording status callback.");
        Log::info($request->all());
        
        // Get the recording details from the request
        $recordingSid = $request->input('RecordingSid');
        $recordingUrl = $request->input('RecordingUrl');
        $callSid = $request->input('CallSid');
        $direction = $request->input('Direction', 'incoming');
        $duration = $request->input('RecordingDuration', 0); // Default to 0 if not provided
        
        // Retrieve the original call details using CallSid
        $callDetails = TwilioCall::where('sid', $callSid)->first();
        
        if (!$callDetails) {
            Log::error("Call details not found for CallSid: {$callSid}");
            return response()->json(['error' => 'Call details not found'], 400);
        }

        // Validate that required fields are present
        if (!$recordingSid || !$recordingUrl || !$callSid) {
            Log::error("Missing required recording data: RecordingSid, RecordingUrl, or CallSid.");
            return response()->json(['error' => 'Missing required recording data'], 400);
        }

        // Update or create the call record
        try {
            $callDetails->update([
                'recording_url' => $recordingUrl,
                'duration' => $duration,
                'direction' => $direction,
            ]);

            Log::info("Recording details saved for call SID: {$callSid}");
        } catch (\Exception $e) {
            Log::error("Error saving recording details: " . $e->getMessage());
            return response()->json(['error' => 'Failed to save recording details'], 500);
        }

        // Optionally download the recording
        $this->downloadRecording($recordingSid, $recordingUrl);

        return response()->json(['status' => 'Recording details saved and downloaded']);
    }
    protected function downloadRecording($recordingSid, $recordingUrl)
    {
        $localFilePath = storage_path("app/call_recordings/{$recordingSid}.mp3");

        Log::info("Saving recording to: {$localFilePath}");

        $username = env('TWILIO_SID');
        $password = env('TWILIO_AUTH_TOKEN');

        // Create context with Basic Authentication
        $context = stream_context_create([
            'http' => [
                'header' => "Authorization: Basic " . base64_encode("{$username}:{$password}"),
            ],
        ]);

        try {
            $response = file_get_contents("{$recordingUrl}.mp3", false, $context);

            if ($response !== false) {
                file_put_contents($localFilePath, $response);
                Log::info("Recording saved to {$localFilePath}");
            } else {
                Log::error("Failed to download recording from URL: {$recordingUrl}");
            }
        } catch (\Exception $e) {
            Log::error("Error downloading recording: " . $e->getMessage());
        }
    }
    public function fallback(Request $request)
    {
        Log::info("Handling fallback request.");
        
        $response = new VoiceResponse();
        $response->say("Sorry, we are experiencing technical difficulties. Please try again later.");
        
        return response($response, 200)->header('Content-Type', 'text/xml');
    }
}
