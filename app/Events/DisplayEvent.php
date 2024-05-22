<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DisplayEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $messages = [];

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        $dataDisplay = Message::all();
        $this->messages[] = [
            'username' => $dataDisplay->user->name,
            'message' => $dataDisplay->message,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('display-channel'),
        ];
    }
}