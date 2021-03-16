<?php

namespace App\Events;

use App\Models\EloquentModelBase;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommonSavingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(EloquentModelBase $model)
    {
        $this->model = $model;
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

    public function __get($name)
    {
        return $this->$name;
    }
}
