<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $message;
    public $unreadCount;

    public function __construct($message, $unreadCount)
    {
        $this->message = $message;
        $this->unreadCount = $unreadCount;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->message->receiver_id);
    }



    public function broadcastWith()
    {

        return [
            'message' => [
                'id' => $this->message->id,
                'content' => $this->message->content,
                'full_datetime' => $this->message->full_datetime,
                'sender_id' => $this->message->sender_id,
                'receiver_id' => $this->message->receiver_id,
                'is_read' => $this->message->is_read,
                'count_unread' => $this->unreadCount,
            ],
        ];

    }



}
