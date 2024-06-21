<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Twiml\VoiceResponse;

class TwilioController extends Controller
{
    public function makeCall(Request $request)
    {
        
        // dd("hello");
            $sid = env('TWILIO_SID');
            $token = env('TWILIO_AUTH_TOKEN');
            $twilioNumber = env('TWILIO_PHONE_NUMBER');

            $client = new Client($sid, $token);

            // Retrieve the 'number' parameter from the request
            $phoneNumber = $request->input('number');

            // Add the prefix "+91" to the phone number
            $to = "+91" . $phoneNumber;
        // try {
        //     // Create TwiML for playing the voice message
        //     $twiml = <<< TWIML
        //         <Response>
        //             <Say voice="alice">I miss you</Say>
        //         </Response>
        //     TWIML;

        //     $call = $client->calls->create(
        //         $to,
        //         $twilioNumber,
        //         [
        //             "twiml" => $twiml
        //         ]
        //     );

        //     return response()->json(['message' => 'Call initiated successfully', 'callSid' => $call->sid]);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
        try {
            $call = $client->calls->create(
                $to,
                $twilioNumber,
                ["url" => route('twilio.voice-response')]
            );

            return response()->json(['message' => 'Call initiated successfully', 'callSid' => $call->sid]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function endCall(Request $request)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $client = new Client($sid, $token);

        $callSid = $request->input('callSid'); // Get the call SID from the request

        try {
            $call = $client->calls($callSid)->update(['status' => 'completed']);
            return response()->json(['message' => 'Call ended successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function voiceResponse()
    {
        $response = new VoiceResponse();
        $response->say("Welcome to the interactive voice response system. Please press 1 for sales, 2 for support, or 3 for more options.", ["voice" => "alice"]);
        $response->gather([
            'numDigits' => 1,
            'action' => route('twilio.handle-user-input'),
            'method' => 'POST'
        ]);

        return response($response, 200)->header('Content-Type', 'text/xml');
    }

    public function handleUserInput(Request $request)
    {
        $digits = $request->input('Digits');
        $response = new VoiceResponse();

        switch ($digits) {
            case '1':
                $response->say("You pressed 1 for sales. Please wait while we connect you to a sales representative.", ["voice" => "alice"]);
                break;
            case '2':
                $response->say("You pressed 2 for support. Please wait while we connect you to a support representative.", ["voice" => "alice"]);
                break;
            case '3':
                $response->say("You pressed 3 for more options. Please stay on the line.", ["voice" => "alice"]);
                break;
            default:
                $response->say("Invalid input. Please try again.", ["voice" => "alice"]);
                $response->redirect(route('twilio.voice-response'), ['method' => 'POST']);
                break;
        }

        return response($response, 200)->header('Content-Type', 'text/xml');
    }
}