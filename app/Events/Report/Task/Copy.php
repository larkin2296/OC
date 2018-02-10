<?php

namespace App\Events\Report\Task;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Copy
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    /*被复制报告id*/
    public $reportId;
    /*报告任务执行者*/
    public $taskUserId;
    /*报告规则*/
    public $regulation;
    /*报告首次接受日期*/
    public $reportFirstReceivedData;
    /*新报告*/
    public $newReport;
    public function __construct($reportId, $taskUserId, $regulation, $reportFirstReceivedData, $newReport)
    {
        $this->reportId = $reportId;
        $this->taskUserId = $taskUserId;
        $this->regulation = $regulation;
        $this->reportFirstReceivedData = $reportFirstReceivedData;
        $this->newReport = $newReport;
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
