<?php

namespace App\Events;

// app/Events/NewServiceEvent.php

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewServiceEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $serviceId;

    public function __construct($message, $serviceId)
    {
        $this->message = $message;
        $this->serviceId = $serviceId;
    }

    public function broadcastOn()
    {
        return new Channel('new-service');
    }
}
