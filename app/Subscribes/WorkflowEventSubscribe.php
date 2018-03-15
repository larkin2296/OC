<?php

namespace App\Subscribes;

use App\Repositories\Interfaces\WorkflowRepository;

class WorkflowEventSubscribe
{   
    /**
     * 锁定用户
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onSetWorkflowId($event)
    {
        $workflowId = $event->workflowId;

        session(['workflow_id' => $workflowId]);
    }

    /**
     * 停用工作流
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onCloseWorkflow($event)
    {
        $companyId = $event->companyId;

        app(WorkflowRepository::class)->closeWorkflow($companyId);
    }

    /**
     * 启用工作流
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onOpenWorkflow($event)
    {
        $companyId = $event->companyId;
        $workflowId = $event->workflowId;

        app(WorkflowRepository::class)->openWorkflow($companyId, $workflowId);
    }

    public function subscribe($events)
    {
        /*设置workflowId*/
        $events->listen(
            'App\Events\Workflow\SetWorkflowId',
            'App\Subscribes\WorkflowEventSubscribe@onSetWorkflowId'
        );

        /*停用工作流*/
        $events->listen(
            'App\Events\Workflow\CloseWorkflow',
            'App\Subscribes\WorkflowEventSubscribe@onCloseWorkflow'
        );

        /*启用工作流*/
        $events->listen(
            'App\Events\Workflow\OpenWorkflow',
            'App\Subscribes\WorkflowEventSubscribe@onOpenWorkflow'
        );
    }
}
