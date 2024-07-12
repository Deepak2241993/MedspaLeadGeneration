<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;
use Twilio\TwiML\VoiceResponse;

class CallController extends Controller
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function outboundCall(Request $request)
    {
        $twilio_number = env('TWILIO_PHONE_NUMBER');
        $userPhoneNumber = "+919599328948"; // The phone number of the user to connect first
        $clientPhoneNumber = '+91' . $request->input('phone'); // The phone number of the client to connect after the user

        try {
            // Call the user first
            $call = $this->twilio->calls->create(
                $userPhoneNumber, // To
                $twilio_number, // From
                [
                    'url' => route('twilio.user-gather', ['client_phone' => $clientPhoneNumber]),
                    'method' => 'POST',
                    'record' => 'true', // Enable call recording
                    'recordingStatusCallback' => route('twilio.recording-status'), // URL to receive recording status updates
                    'recordingStatusCallbackMethod' => 'POST' // Method to send recording status updates
                ]
            );

            // Log the Call SID for debugging
            Log::info('Call initiated with SID: ' . $call->sid);

            // Store the Call SID in the session for later use (optional)
            session(['twilio_call_sid' => $call->sid]);

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
            $callSid = session('twilio_call_sid');

            if (!$callSid) {
                return response()->json(['error' => 'No active call found.']);
            }

            // End the call
            $this->twilio->calls($callSid)->update(['status' => 'completed']);

            // Clear the Call SID from the session
            session()->forget('twilio_call_sid');

            return response()->json(['success' => 'Call ended successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to end call: ' . $e->getMessage()]);
        }
    }

    public function muteCall(Request $request)
    {
        $callSid = session('twilio_call_sid');

        try {
            $this->twilio->calls($callSid)->update(['muted' => true]);
            return response()->json(['success' => true, 'message' => 'Call muted successfully.']);
        } catch (\Exception $e) {
            Log::error('Error muting call: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function holdCall(Request $request)
    {
        $callSid = session('twilio_call_sid');

        try {
            // Update the call to hold status
            $this->twilio->calls($callSid)->update(['status' => 'in-progress']);
            $this->twilio->calls($callSid)->update(['hold' => true]);
            return response()->json(['success' => true, 'message' => 'Call put on hold successfully.']);
        } catch (\Exception $e) {
            Log::error('Error putting call on hold: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
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
        // Log the recording status information for debugging
        Log::info('Recording Status Callback: ', $request->all());

        // Handle the recording status update (e.g., save recording SID to the database)
        // $recordingSid = $request->input('RecordingSid');

        return response()->json(['status' => 'Recording status received']);
    }

}
