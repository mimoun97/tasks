<?php

namespace App\Events\Tasks;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;
    public $oldTask;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($task, $oldTask = null)
    {
        $this->task = $task;
        $this->oldTask = $oldTask;
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
