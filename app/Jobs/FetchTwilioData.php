<?php

namespace App\Jobs;

use Twilio\Rest\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class FetchTwilioData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $currentUserPhone;

    public function __construct($currentUserPhone)
    {
        $this->currentUserPhone = $currentUserPhone;
    }

    public function handle()
    {
        $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $currentUser = '+91' . $this->currentUserPhone;

        // Fetch messages and calls
        $receivedMessages = $client->messages->read(['to' => $currentUser, 'limit' => 5]);
        $sentMessages = $client->messages->read(['from' => $currentUser, 'limit' => 5]);
        $receivedCalls = $client->calls->read(['to' => $currentUser, 'limit' => 5]);
        $sentCalls = $client->calls->read(['from' => $currentUser, 'limit' => 5]);

        // Combine messages and calls
        $messages = array_merge($receivedMessages, $sentMessages);
        $calls = array_merge($receivedCalls, $sentCalls);

        // Format messages
        $formattedMessages = [];
        foreach ($messages as $message) {
            $direction = $message->from == $currentUser ? 'outgoing' : 'incoming';
            $formattedMessages[] = [
                'type' => 'message',
                'from' => $message->from,
                'to' => $message->to,
                'body' => $message->body,
                'direction' => $direction,
                'created_at' => $message->dateSent ? $message->dateSent->format('Y-m-d H:i:s') : null,
            ];
        }

        // Format calls with pagination
        $formattedCalls = [];
        $page = 0;
        $limit = 5;

        try {
            do {
                $calls = $client->calls->read(['to' => $currentUser, 'limit' => $limit, 'page' => $page]);
                foreach ($calls as $call) {
                    $direction = $call->from == $currentUser ? 'outgoing' : 'incoming';
                    $duration = isset($call->duration) ? gmdate("H:i:s", (int)$call->duration) : '00:00:00';
                    $recordings = $client->recordings->read(['callSid' => $call->sid, 'limit' => 1]);
                    $recordingUrl = !empty($recordings) ? 'https://api.twilio.com' . $recordings[0]->uri . '.mp3?Download=true' : null;

                    $formattedCalls[] = [
                        'type' => 'call',
                        'from' => $call->from,
                        'to' => $call->to,
                        'duration' => $duration,
                        'recording_url' => $recordingUrl,
                        'direction' => $direction,
                        'created_at' => $call->dateCreated ? $call->dateCreated->format('Y-m-d H:i:s') : null,
                    ];
                }

                $page++;
                if (count($calls) < $limit) {
                    break;
                }
            } while (true);

        } catch (\Exception $e) {
            Log::error('Error fetching calls: ' . $e->getMessage());
        }

        // Sort messages and calls
        usort($formattedMessages, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        usort($formattedCalls, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        // Cache the formatted data
        Cache::put('twilio_data_' . $this->currentUserPhone, [
            'messages' => $formattedMessages,
            'calls' => $formattedCalls,
        ], now()->addMinutes(10));
    }
}
