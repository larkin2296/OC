<?php

namespace App\Events\DataTrace;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReportValueCreate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $oldValues;
    public $newValues;
    public $attributes;
    public $reportId;
    public $userId;
    public function __construct($oldValues, $newValues, $attributes, $reportId, $userId)
    {
        $this->oldValues = $oldValues;
        $this->newValues = $newValues;
        $this->attributes = $attributes;
        $this->reportId = $reportId;
        $this->userId = $userId;
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
