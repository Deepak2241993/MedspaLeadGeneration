<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;

class TwilioController extends Controller
{
    public function handleIncomingCall(Request $request)
    {
        Log::info('Incoming call received.');

        // Create a new TwiML response
        $response = new VoiceResponse();

        // Add a message to greet the caller and provide options
        $gather = $response->gather([
            'numDigits' => 1,
            'action' => route('handle-gather'), // Route to handle the gathered input
            'method' => 'POST'
        ]);
        $gather->say('Thank you for calling! Press 1 to connect to the sales team, or press 2 to connect to the accounts team.');
        $gather->pause(['length' => 4]);
        $gather->say('Thank you for calling! Press 1 to connect to the sales team, or press 2 to connect to the accounts team.');

        // Log the TwiML response as XML
        Log::info('TwiML Response generated:', ['xml' => $response->asXML()]);

        // Return the TwiML response as XML
        return response($response)->header('Content-Type', 'text/xml');
    }

    public function handleGather(Request $request)
    {
        Log::info('Handling gather request.');

        // Create a new TwiML response
        $response = new VoiceResponse();

        // Check the input from the caller
        $digitsPressed = $request->input('Digits');
        if ($digitsPressed == '1') {
            Log::info('Caller pressed 1. Initiating call to sales team.');

            // Dial to connect to the sales team and record the call
            $dial = $response->dial('+918920005414', [
                'record' => 'record-from-ringing-dual',
                'recordingStatusCallback' => route('handle-recording-status'),
                'recordingStatusCallbackMethod' => 'POST'
            ]);
        } elseif ($digitsPressed == '2') {
            Log::info('Caller pressed 2. Initiating call to accounts team.');

            // Dial to connect to the accounts team and record the call
            $dial = $response->dial('+918920005414', [
                'record' => 'record-from-ringing-dual',
                'recordingStatusCallback' => route('handle-recording-status'),
                'recordingStatusCallbackMethod' => 'POST'
            ]);
        } else {
            Log::info('Invalid input. Ending call.');

            // Play a thank you message
            $response->say('Thank you for calling!');
            $response->hangup();
        }

        // Log the TwiML response as XML
        Log::info('TwiML Response generated:', ['xml' => $response->asXML()]);

        // Return the TwiML response as XML
        return response($response)->header('Content-Type', 'text/xml');
    }

    public function handleRecordingStatus(Request $request)
    {
        Log::info('Recording status callback received.', $request->all());

        // Handle the recording status, e.g., save the recording URL to your database

        return response()->json(['status' => 'Recording status received.']);
    }
}
