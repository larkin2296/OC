<?php

namespace App\Subscribes;

use App\Repositories\Interfaces\WorkflowNodeRepository;

class WorkflowNodeEventSubscribe
{   
    /**
     * 设置工作流id
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onSetWorkflowId($event)
    {
        $workflowNode = $event->workflowNode;
        $workflowId = $event->workflowId;

        $workflowNode->workflow_id = $workflowId;
        $workflowNode->save();
    }

    /**
     * 工作流节点排序
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onSort($event)
    {
        $prevNodeId = $event->prevNodeId;

        $curNode = $event->curNode;
        $workflowId = $curNode->workflow_id;

        $preNodeSort = 0;

        if($prevNodeId) {
            /*被插入的节点*/
            $prevNode = app(WorkflowNodeRepository::class)->find($prevNodeId);
            /*被插入节点的排序*/
            $preNodeSort = $prevNode->sort;
        }

        /*自动递增被插入节点之后的sort，其值+1*/
        app(WorkflowNodeRepository::class)->incrementLargerSort($workflowId, $preNodeSort);

        /*设置当前节点为被插入点之后*/
        $curNode->sort = $preNodeSort + 1;
        $curNode->save();

        // dd($curNode);

    }

    public function subscribe($events)
    {
        /*设置workflowId*/
        $events->listen(
            'App\Events\WorkflowNode\SetWorkflowId',
            'App\Subscribes\WorkflowNodeEventSubscribe@onSetWorkflowId'
        );

        /*设置workflowId*/
        $events->listen(
            'App\Events\WorkflowNode\Sort',
            'App\Subscribes\WorkflowNodeEventSubscribe@onSort'
        );
    }
}
