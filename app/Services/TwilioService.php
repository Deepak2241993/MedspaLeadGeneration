<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioService
{
    protected $client;

    public function __construct()
    {
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');

        try {
            $this->client = new Client($accountSid, $authToken);
        } catch (\Exception $e) {
            Log::error('Error initializing Twilio client: ' . $e->getMessage());
            throw $e;
        }
    }

    public function makeCall($to, $twimlUrl, $statusCallbackUrl)
    {
        try {
            Log::info('Initiating call to: ' . $to);
            Log::info('Using TwiML URL: ' . $twimlUrl);
            Log::info('Status callback URL: ' . $statusCallbackUrl);

            $call = $this->client->calls->create(
                $to, // The number to call
                env('TWILIO_PHONE_NUMBER'), // Your Twilio number
                [
                    'url' => $twimlUrl, // URL for TwiML instructions
                    'method' => 'GET',
                    'statusCallback' => $statusCallbackUrl,
                    'statusCallbackMethod' => 'POST',
                    'statusCallbackEvent' => ['initiated', 'ringing', 'answered', 'completed']
                ]
            );

            Log::info('Call initiated: ' . $call->sid);
            return $call;
        } catch (\Exception $e) {
            Log::error('Error making call: ' . $e->getMessage());
            throw $e;
        }
    }
}