<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\TrMessages; 
// use App\User; 

class ChatMessageReceived  implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;


    public $message;

    // public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TrMessages $chatMessage)
    {
        $this->message = $chatMessage;

        // dd($this->message);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('jaasaria_channel');
    }
    public function broadcastAs()
    {
        return 'App\Events\ChatMessageReceived';
    }


}
