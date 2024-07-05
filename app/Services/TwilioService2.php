<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function makeCall($to, $twimlUrl, $statusCallbackUrl)
    {
        try {
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
