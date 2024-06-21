<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Exceptions\TwilioException;
use Twilio\TwiML\VoiceResponse;
use Twilio\Rest\Client;
use Twilio\Twiml;

class TwilioController extends Controller
{
    // public function makeCall()
    // {

        
    //     // Twilio Credentials
    //     $accountSid = 'AC1ed59c9572c8062d05dc1d7d12777712';
    //     $authToken = 'e13ac721da86113d3e0390490601cb9f';
    //     $twilioNumber = '+18335302118';

    //     // Initialize Twilio Client
    //     $twilio = new Client($accountSid, $authToken);

    //     // Make a call
    //     $call = $twilio->calls->create(
    //         '+18482192921', // Destination number
    //         $twilioNumber,     // Twilio phone number
    //         [
    //             'url' => route('admin.twilio.voice') // URL that returns TwiML instructions for the call
    //         ]
    //     );

    //     // Output call SID
    //     echo 'Call SID: ' . $call->sid;
    // }
    public function showMakeCallForm()
    {
        return view('admin.call.show-make-call-form');
    }

    

//    public function makeCall(Request $request)
//     {
//         $twilioSid = env('TWILIO_SID');
//         $twilioToken = env('TWILIO_AUTH_TOKEN');
//         $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');

//         $recipientNumber = $request->input('recipient_number');

//         $twilio = new Client($twilioSid, $twilioToken);

//         $call = $twilio->calls
//             ->create($recipientNumber, // recipient number
//                      $twilioPhoneNumber, // Twilio number
//                      array(
//                          "url" => "http://demo.twilio.com/docs/voice.xml" // URL to TwiML document
//                      )
//             );

//         // Log or handle call creation success/failure here

//         return "Call initiated to $recipientNumber!";
//     }


// public function makeCall(Request $request)
// {
//     $twilioSid = env('TWILIO_SID');
//     $twilioToken = env('TWILIO_AUTH_TOKEN');
//     $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');

//     $recipientNumber = $request->input('recipient_number');

//     $twilio = new Client($twilioSid, $twilioToken);

//     try {
//         $call = $twilio->calls
//             ->create($recipientNumber, // recipient number
//                      $twilioPhoneNumber, // Twilio number
//                      array(
//                          "url" => "http://demo.twilio.com/docs/voice.xml" // URL to TwiML document
//                      )
//             );

//         // Log success
//         \Log::info("Call initiated to $recipientNumber. Call SID: " . $call->sid);

//         return "Call initiated to $recipientNumber!";
//     } catch (\Twilio\Exceptions\TwilioException $e) {
//         // Log failure
//         \Log::error("Failed to initiate call to $recipientNumber. Error: " . $e->getMessage());

//         return "Failed to initiate call. Please try again later.";
//     }
// }

public function makeCall(Request $request)
{
    $twilioSid = env('TWILIO_SID');
    $twilioToken = env('TWILIO_AUTH_TOKEN');
    $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');

    $recipientNumber = $request->input('recipient_number');
    $recipientName = $request->input('recipient_name'); // Assuming the recipient's name is passed in the request

    $twilio = new Client($twilioSid, $twilioToken);

    // Define your custom message with dynamic content
    $customMessage = "Hello $recipientName! This is your custom message. Please leave your message after the tone.";

    // Create the TwiML with the custom message
    $twiml = "<Response><Say>$customMessage</Say><Record maxLength='2' /></Response>";

    try {
        $call = $twilio->calls
            ->create($recipientNumber, // recipient number
                     $twilioPhoneNumber, // Twilio number
                     array(
                         "record" => True,
                         "twiml" => $twiml // Custom TwiML with message and recording
                     )
            );

        // Log success
        \Log::info("Call initiated to $recipientNumber. Call SID: " . $call->sid);

        return "Call initiated to $recipientNumber!";
    } catch (\Twilio\Exceptions\TwilioException $e) {
        // Log failure
        \Log::error("Failed to initiate call to $recipientNumber. Error: " . $e->getMessage());

        return "Failed to initiate call. Please try again later.";
    }
}

    // public function voiceResponse()
    // {
    //     $response = new \Twilio\TwiML\VoiceResponse();
    //     $response->say('Hello, this is a call from Twilio.');
    //     return $response;
    // }
    public function handleIncomingCall(Request $request)
    {
        // Retrieve caller ID from the request
        $callerId = $request->input('Caller');

        // Render the view with the caller ID
        return view('handle-call', ['callerId' => $callerId]);
    }


    public function generateTwiML()
    {
        // $response = new VoiceResponse();

        $response = new Twiml();

        $gather = $response->gather([
            'input' => 'speech dtmf',
            'timeout' => 5,
            'action' => route('handle-incoming-call')
        ]);

        $gather->say('Please respond with your answer.');

        return $response;
    }

    public function handleResponse(Request $request)
    {
        $userResponse = $request->input('SpeechResult');
        // Process the user's response
        \Log::info('User response: ' . $userResponse);

        return response('<Response><Hangup/></Response>', 200)
            ->header('Content-Type', 'application/xml');
    }

    public function getRecordedCalls($phoneNumber)
    {
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');

        $twilio = new Client($twilioSid, $twilioToken);

        // Fetch recorded calls for the specified phone number
        $recordedCalls = $twilio->calls
            ->read([
                'to' => $phoneNumber,
                'status' => 'completed', // Filter by call status (optional)
                'limit' => 10, // Limit the number of calls to retrieve (optional)
            ]);

        return $recordedCalls;
    }

    public function showRecordedCalls($phoneNumber)
    {
        $recordedCalls = $this->getRecordedCalls($phoneNumber);

        // dd($recordedCalls);
        return view('admin.call.recorded-calls', ['recordedCalls' => $recordedCalls]);
    }

    public function showRecordedCallsWithRecordings($phoneNumber)
    {
        $recordedCalls = $this->getRecordedCallsWithRecordings($phoneNumber);

        return view('recorded-calls', ['recordedCalls' => $recordedCalls]);
    }

    // public function downloadRecording(Request $request)
    // {
    //     $recordingSid = $request->input('recordingSid');
    //     $tempFilePath = $this->downloadRecording($recordingSid);

    //     // Return the downloaded file
    //     return response()->download($tempFilePath, 'recording.mp3')->deleteFileAfterSend(true);
    // }

    public function downloadRecording($recordingSid)
    {
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');

        $twilio = new Client($twilioSid, $twilioToken);

        // Fetch the recording details
        $recording = $twilio->recordings($recordingSid)->fetch();

        // Download the recording
        $recordingContent = Http::get($recording->uri)->body();

        // Save the recording to a temporary file
        $tempFilePath = tempnam(sys_get_temp_dir(), 'twilio_recording_');
        file_put_contents($tempFilePath, $recordingContent);

        // Return the path to the temporary file
        return $tempFilePath;
    }





}
