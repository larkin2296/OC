<?php

namespace App\Listeners\Regulation;

use App\Events\Regulation\Update;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Interfaces\ReportTaskRepository;
use App\Traits\Services\Report\TaskTrait;

class UpdateListener implements ShouldQueue
{
    use InteractsWithQueue, TaskTrait;
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'beanstalkd';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'high';

    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $reportTaskRepo;

    public function __construct()
    {
        $this->reportTaskRepo = app(ReportTaskRepository::class);
    }

    /**
     * Handle the event.
     *
     * @param  Update  $event
     * @return void
     */
    public function handle(Update $event)
    {
        /*报告规则模型*/
        $model = $event->model;

        $this->setRegulationBak($model);

        /*获取报告任务*/
        $reportTasks = $this->reportTaskRepo->findWhere($where);

        $organizeMaps = array_flip(getRoleOrganizeMap());

        /*报告任务不为空*/
        if( $reportTasks->isNotEmpty() ) {
            foreach($reportTasks as $reportTask) {
                $this->setCountdown($reportTask, $organizeMaps);
            }
        }
    }
}
