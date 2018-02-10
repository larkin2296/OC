<?php

namespace App\Listeners\Report\Task;

use App\Events\Report\Task\SetRedundanceData;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Interfaces\ReportTaskRepository;

class SetRedundanceDataListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $reportTaskRepo;

    public function __construct(
        ReportTaskRepository $reportTaskRepo
    )
    {
        $this->reportTaskRepo = $reportTaskRepo;
    }

    /**
     * Handle the event.
     *
     * @param  SetRedundanceData  $event
     * @return void
     */
    public function handle(SetRedundanceData $event)
    {
        $companyId = $event->companyId;
        $reportId = $event->reportId;
        $data = $event->data;

        $where = [
            'company_id' => $companyId,
            'report_id' => $reportId,
        ];
        $this->reportTaskRepo->updateWhere($data, $where);
    }
}
