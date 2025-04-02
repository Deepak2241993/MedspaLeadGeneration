<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\TwiML\VoiceResponse;
use App\Models\TwilioCall;
use Illuminate\Support\Facades\Log;

class TwilioController extends Controller
{
    // Handle Incoming Call
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

    // Handle Gather Input (User pressed a digit)
    public function handleGather(Request $request)
    {
        Log::info("Handling gather request.");
        $digits = $request->input('Digits');

        $response = new VoiceResponse();

        if ($digits == 1) {
            Log::info("Caller pressed 1. Connecting to the sales team.");
            // Dial the sales team
            $response->dial('+918920005414', [
                'record' => 'record-from-ringing-dual',
                'recordingStatusCallback' => url('/twilio/handle-recording-status'),
                'recordingStatusCallbackMethod' => 'POST'
            ]);
        } elseif ($digits == 2) {
            Log::info("Caller pressed 2. Connecting to the accounts team.");
            // Dial the accounts team
            $response->dial('+918920005414', [
                'record' => 'record-from-ringing-dual',
                'recordingStatusCallback' => url('/twilio/handle-recording-status'),
                'recordingStatusCallbackMethod' => 'POST'
            ]);
        } else {
            // Invalid input, repeat the options
            $response->say("Invalid option. Please try again.");
            $response->redirect(route('/twilio/inbound-call'));
        }

        return response($response, 200)->header('Content-Type', 'text/xml');
    }

    // Handle Recording Status
    public function handleRecordingStatus(Request $request)
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

    // Handle Call Status Changes
    public function handleCallStatus(Request $request)
    {
        Log::info("Call status updated.");
        Log::info($request->all());
        
        // Handle call lifecycle events (ringing, in-progress, completed, etc.)
        return response('Call Status Received', 200);
    }

    // Fallback Route (when primary webhook fails)
    public function fallback(Request $request)
    {
        Log::info("Handling fallback request.");
        
        $response = new VoiceResponse();
        $response->say("Sorry, we are experiencing technical difficulties. Please try again later.");
        
        return response($response, 200)->header('Content-Type', 'text/xml');
    }
}
