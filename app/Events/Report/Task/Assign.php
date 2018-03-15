<?php

//原始资料分发录入员
namespace App\Events\Report\Task;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Assign
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $taskUserId;
    public $source;
    public $regulation;
    public function __construct($taskUserId, $source, $regulation)
    {
        /*任务处理人*/
        $this->taskUserId = $taskUserId;
        /*原始资料*/
        $this->source = $source;
        /*报告规则*/
        $this->regulation = $regulation;
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
