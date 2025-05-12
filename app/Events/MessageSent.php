<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $message;
    public function __construct($message)
    {
        Log::info('MessageSent event constructor');
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        Log::info('MessageSent event broadcastOn');
        try {
            $channel = 'chat.' . $this->message['sender_id'] . '.' . $this->message['recipient_id'];
            Log::info('Broadcasting to channel: ' . $channel);
            return [
                new Channel($channel),
            ];
        } catch (\Exception $e) {
            Log::error('Error in broadcastOn: ' . $e->getMessage());
            return [];
        }
    }


    public function broadcastWith()
    {
        Log::info('MessageSent event broadcastWith');
        return [
            'message' => $this->message,
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'MessageSent';
    }
}
