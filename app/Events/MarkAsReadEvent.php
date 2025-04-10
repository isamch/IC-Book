<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MarkAsReadEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $user_send_meg;
    public $user_seen_id;

    public function __construct($user_send_meg, $user_seen_id)
    {
        $this->user_send_meg = $user_send_meg;
        $this->user_seen_id = $user_seen_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */


    public function broadcastOn(): Channel
    {
        return new PrivateChannel('seen.' . $this->user_send_meg);
    }

    public function broadcastWith()
    {
        return [
            'user_seen_id' => $this->user_seen_id,
            'user_send_meg' => (int) $this->user_send_meg,
        ];
    }


}
