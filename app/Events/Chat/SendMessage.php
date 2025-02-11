<?php

namespace App\Events\Chat;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $usernotification;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message, int $usernotification)
    {
        $this->message = $message;
        $this->usernotification = $usernotification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->usernotification);
       
    } 
    public function broadcastAs()
    {
        return 'SendMessage';
    }
    public function broadcastWith()
    {
        return [
            'message' => $this->message
        ];
    }
}
