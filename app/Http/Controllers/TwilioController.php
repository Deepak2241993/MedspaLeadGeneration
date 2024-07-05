<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;

class TwilioController extends Controller
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function outbondCall(Request $request) 
    {
        // I want to cannect the call to the User and then connect to the clint 
    }

    public function makeCall(Request $request)
    {
        $leadPhone = '+91' . $request->input('phone'); // Prepend +91 to the phone number

        try {
            $call = $this->twilio->calls->create(
                $leadPhone,
                env('TWILIO_PHONE_NUMBER'),
                [
                    'url' => route('handleCall'), // Ensure this route is defined
                    'statusCallback' => route('callStatusCallback'), // Add status callback URL
                    'statusCallbackEvent' => ['initiated', 'ringing', 'answered', 'completed']
                ]
            );

            // Log the Call SID for debugging
            Log::info('Call initiated with SID: ' . $call->sid);

            // Store the Call SID in the session for later use (optional)
            session(['twilio_call_sid' => $call->sid]);

            return response()->json(['message' => 'Call initiated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function handleCall()
    {
        $response = new VoiceResponse();
        $gather = $response->gather([
            'numDigits' => 1,
            'action' => route('connectToAgent'), // Use named route for clarity
            'method' => 'POST',
        ]);
        $gather->say('Hello! This is a call from MedSpa. Please press 1 for Sales, 2 for Support, or 3 for Billing.', ['voice' => 'alice']);
        $response->say('We did not receive any input. Goodbye!', ['voice' => 'alice']);

        return response($response, 200)->header('Content-Type', 'text/xml');
    }

    public function connectToAgent(Request $request)
    {
        $response = new VoiceResponse();

        $inputDigit = $request->input('Digits');

        if ($inputDigit === '1') {
            $response->say('Connecting you to an Sales agent.', ['voice' => 'alice']);
            $response->dial('+919955053774'); // Replace with the agent's phone number
        } else {
            $response->say('Invalid input. Goodbye!', ['voice' => 'alice']);
        }
        if ($inputDigit === '2') {
            $response->say('Connecting you to an Support agent.', ['voice' => 'alice']);
            $response->dial('+918920504677'); // Replace with the agent's phone number
        } else {
            $response->say('Invalid input. Goodbye!', ['voice' => 'alice']);
        }
        if ($inputDigit === '3') {
            $response->say('Connecting you to an Billing agent.', ['voice' => 'alice']);
            $response->dial('+918920005414'); // Replace with the agent's phone number
        } else {
            $response->say('Invalid input. Goodbye!', ['voice' => 'alice']);
        }
       

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

    public function getConferences()
    {
        try {
            $conferences = $this->twilio->conferences->read(['status' => 'in-progress']);
            Log::info('Fetched in-progress conferences:', $conferences); // Log the fetched conferences
            return response()->json($conferences);
        } catch (\Exception $e) {
            Log::error('Error fetching conferences: ' . $e->getMessage()); // Log the error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getParticipants($conferenceSid)
    {
        try {
            $participants = $this->twilio->conferences($conferenceSid)->participants->read();
            Log::info("Fetched participants for conference SID {$conferenceSid}:", $participants); // Log the fetched participants
            return response()->json($participants);
        } catch (\Exception $e) {
            Log::error("Error fetching participants for conference SID {$conferenceSid}: " . $e->getMessage()); // Log the error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function muteParticipant($conferenceSid, $participantSid)
    {
        try {
            Log::info("Attempting to mute participant: Conference SID - {$conferenceSid}, Participant SID - {$participantSid}");

            $participant = $this->twilio->conferences($conferenceSid)
                                        ->participants($participantSid)
                                        ->update(['muted' => true]);

            Log::info('Participant muted successfully.');
            return response()->json(['success' => true, 'message' => 'Participant muted successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Failed to mute participant: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to mute participant.'], 500);
        }
    }


    public function unmuteParticipant($conferenceSid, $participantSid)
    {
        try {
            $participant = $this->twilio->conferences($conferenceSid)
                                        ->participants($participantSid)
                                        ->update(['muted' => false]);

            Log::info('Participant unmuted successfully.');
            return response()->json(['success' => true, 'message' => 'Participant unmuted successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Failed to unmute participant: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to unmute participant.'], 500);
        }
    }

    public function holdParticipant($conferenceSid, $participantSid)
    {
        try {
            $participant = $this->twilio->conferences($conferenceSid)
                                        ->participants($participantSid)
                                        ->update(['hold' => true]);

            Log::info('Participant put on hold successfully.');
            return response()->json(['success' => true, 'message' => 'Participant put on hold successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Failed to put participant on hold: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to put participant on hold.'], 500);
        }
    }

    public function unholdParticipant($conferenceSid, $participantSid)
    {
        try {
            $participant = $this->twilio->conferences($conferenceSid)
                                        ->participants($participantSid)
                                        ->update(['hold' => false]);

            Log::info('Participant resumed from hold successfully.');
            return response()->json(['success' => true, 'message' => 'Participant resumed from hold successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Failed to resume participant from hold: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to resume participant from hold.'], 500);
        }
    }

    public function callStatusCallback(Request $request)
    {
        Log::info('Twilio Status Callback', $request->all());

        $callSid = $request->input('CallSid');
        $callStatus = $request->input('CallStatus');

        if ($callStatus === 'in-progress') {
            // Call answered, start the timer
            session(['call_start_time' => now()]);
        } elseif ($callStatus === 'completed') {
            // Call ended, calculate the duration
            $callStartTime = session('call_start_time');
            if ($callStartTime) {
                $callEndTime = now();
                $callDuration = $callStartTime->diffInSeconds($callEndTime);
                session()->forget('call_start_time');
                session(['call_duration' => $callDuration]);
            }
        }

        return response()->json(['status' => 'received']);
    }

    public function getCallDuration()
    {
        $callDuration = session('call_duration');

        if ($callDuration) {
            return response()->json(['success' => true, 'duration' => gmdate('H:i:s', $callDuration)]);
        } else {
            return response()->json(['success' => false, 'message' => 'No call duration found']);
        }
    }
}
