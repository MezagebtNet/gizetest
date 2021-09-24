<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\BatchChannelvideo;

class ScheduledVideoStarted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $batch_channelvideo;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, BatchChannelvideo $batch_channelvideo)
    {
        $this->user = $user;
        $this->batch_channelvideo = $batch_channelvideo;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
