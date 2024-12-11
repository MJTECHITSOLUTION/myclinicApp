<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifyMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $result;

    public function __construct($result)
    {
        $this->result = $result;
    }
  
    public function broadcastOn()
    {
        try {
            return new Channel('notify-channel');
        } catch (\Exception $e) {
            \Log::error('Broadcasting error: ' . $e->getMessage());
            return new Channel('notify-channel'); // Fallback
        }
    }
  
    public function broadcastAs()
    {
        return 'form-submit';
    }
}
