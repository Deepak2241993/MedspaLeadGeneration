<?php 

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CallEnded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $callSid;

    public function __construct($callSid)
    {
        $this->callSid = $callSid;
    }

    // Specify the broadcast channel
    public function broadcastOn()
    {
        return new Channel('calls');
    }

   public function broadcastAs()
    {
        return 'CallEnded'; // Set a custom event name
    }
}
