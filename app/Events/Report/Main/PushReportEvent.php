<?php

namespace App\Events\Report\Main;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
class PushReportEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $report_identifier;
    public $report_first_received_date;
    public $report_drug_safety_date;
    public $create_version_cause;
    public $sourceId;
    public $companyId;

    public function __construct($report_identifier,$report_first_received_date,$report_drug_safety_date,$create_version_cause, $sourceId, $companyId)
    {
        //报告编号
        $this->report_identifier = $report_identifier;
        //接受报告时间
        $this->report_first_received_date = $report_first_received_date;
        //PV部门获知时间
        $this->report_drug_safety_date = $report_drug_safety_date;
        //创建新版本的原因
        $this->create_version_cause = $create_version_cause;
        $this->sourceId = $sourceId;
        $this->companyId = $companyId;


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
