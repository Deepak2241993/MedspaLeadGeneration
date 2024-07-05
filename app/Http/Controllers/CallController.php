<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class CallController extends Controller
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
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
