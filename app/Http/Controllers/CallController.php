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
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilio_number = env('TWILIO_PHONE_NUMBER');
        $client = new Client($sid, $token);

        $userPhoneNumber = "+919599328948"; // The phone number of the user to connect first
        $clientPhoneNumber = $request->input('phone'); // The phone number of the client to connect after the user

        // Call the user first
        $call = $client->calls->create(
            $userPhoneNumber, // To
            $twilio_number, // From
            [
                'url' => route('twilio.user-gather', ['client_phone' => $clientPhoneNumber])
            ]
        );

        return response()->json(['status' => 'Call initiated', 'call_sid' => $call->sid]);
    }

    public function userGather(Request $request)
    {
        $clientPhoneNumber = $request->query('client_phone');

        $response = new VoiceResponse();
        $dial = $response->dial();
        $dial->number($clientPhoneNumber);
         // Log the Call SID for debugging
         Log::info('Call initiated with SID: ' . $response );

        return response($response, 200)->header('Content-Type', 'text/xml');
    }

    public function endCall(Request $request)
    {
        $callSid = $request->input('callSid');

        try {
            $this->twilio->calls($callSid)->update(['status' => 'completed']);
            return response()->json(['success' => true, 'message' => 'Call ended successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function muteCall(Request $request)
    {
        $callSid = $request->input('callSid');

        try {
            $this->twilio->calls($callSid)->update(['muted' => true]);
            return response()->json(['success' => true, 'message' => 'Call muted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function holdCall(Request $request)
    {
        $callSid = $request->input('callSid');

        try {
            $this->twilio->calls($callSid)->update(['status' => 'in-progress', 'hold' => true]);
            return response()->json(['success' => true, 'message' => 'Call put on hold successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
