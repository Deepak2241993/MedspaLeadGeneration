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
    
            // Dial to connect to the sales team (replace with your actual sales team number)
            $response->dial('+917453085088');
        } elseif ($digitsPressed == '2') {
            Log::info('Caller pressed 2. Initiating call to accounts team.');
    
            // Dial to connect to the accounts team (replace with your actual accounts team number)
            $response->dial('+919955053774');
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
    
}
