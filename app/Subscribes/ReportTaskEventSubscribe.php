<?php

namespace App\Subscribes;

use App\Repositories\Interfaces\UserRepository;
use App\Repositories\Interfaces\ReportTaskRepository;
use App\Traits\Services\Report\TaskTrait;
use Carbon\Carbon;

class ReportTaskEventSubscribe
{   
    use TaskTrait;

    /**
     * 设置报告任务的执行者
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onReassign($event)
    {
        $taskUserId = $event->taskUserId;
        $reportTask = $event->reportTask;

        /*获取报告任务执行者信息*/
        $taskUser = app(UserRepository::class)->find($taskUserId);

        /*保存*/
        $this->setReportTaskUserInReportTask($taskUser, $reportTask);
    }

    /**
     * 设置任务执行者信息
     * @param [type] $taskUserId [description]
     * @param [type] $reportTask [description]
     */
    private function setReportTaskUserInReportTask($taskUser, $reportTask)
    {
        /*保存*/
        $reportTask->task_user_id = $taskUser->id;
        $reportTask->task_user_name = $taskUser->name;
        $reportTask->save();
    }

    /**
     * 设置组织结构角色
     * @param [type] $taskUserId [description]
     * @param [type] $reportTask [description]
     */
    private function initOrganizeRoleInReportTask($reportTask)
    {
        /*保存*/
        $organizeRoleId = getRoleOrganizeValue('data_insert');
        $organizes = getRoleOrganize();

        $reportTask->organize_role_id = $organizeRoleId;
        $reportTask->organize_role_name = $organizes[$organizeRoleId];
        $reportTask->save();   
    }

    /**
     * 原始资料分发给录入员
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onAssign($event)
    {
        /*任务处理人*/
        $taskUserId = $event->taskUserId;
        /*原始资料*/
        $source = $event->source;
        /*报告规则*/
        $regulation = $event->regulation;

        $reportTaskRepo = app(ReportTaskRepository::class);

        /*创建报告任务*/
        $reportTaskData = [
            'report_first_received_date' => $source->accept_report_date,
            'assigned_at' => new \Carbon\Carbon(),
            'source_id' => $source->id,
            'regulation_id' => $regulation->id,
        ];
        $reportTask = $this->createReportTask($reportTaskData);

        /*获取报告任务执行者信息*/
        $taskUser = app(UserRepository::class)->find($taskUserId);

        /*设置报告任务的其他数据*/
        $this->setReportTaskData($reportTask, $taskUser, $regulation);
    }

    /**
     * 创建报告任务
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    private function createReportTask($data)
    {
        return app(ReportTaskRepository::class)->create($data);
    }

    /**
     * 创建报告任务
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onCreate($event)
    {
        $report = $event->report;
        $companyId = $report->companyId;
        $regulation = $event->regulation;
        $taskUserId = $event->taskUserId;

        $data = [
            'company_id' => $companyId,
            'report_id' => $report->id,
            'report_identify' => $report->report_identifier,
            'report_first_received_date' => $report->report_first_received_date,
            'assigned_at' => new \Carbon\Carbon(),
            'drug_name' => $report->drug_name,
            'first_drug_name' => $report->first_drug_name,
            'event_term' => $report->event_term,
            'first_event_term' => $report->first_event_term,
            'seriousness' => $report->seriousness,
            'report_cate' => getCommonCheckValue(true),
            'received_from_id' => $report->received_from_id,
            'status' => getCommonCheckValue(false),
            'regulation_id' => $regulation->id,
        ];

        /*创建报告任务*/
        $reportTask = $this->createReportTask($data);

        /*获取报告任务执行者信息*/
        $taskUser = app(UserRepository::class)->find($taskUserId);

        /*设置报告任务的其他数据*/
        $this->setReportTaskData($reportTask, $taskUser, $regulation);

        return $reportTask;
    }

    /**
     * 修改报告任务
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onUpdate($event)
    {
        $report = $event->report;
        $companyId = $report->companyId;
        $regulation = $event->regulation;
        $sourceId = $event->sourceId;

        $data = [
            'report_id' => $report->id,
            'report_identify' => $report->report_identifier,
            'report_first_receive_date' => $report->report_first_receive_date,
            'drug_name' => $report->drug_name,
            'first_drug_name' => $report->first_drug_name,
            'event_term' => $report->event_term,
            'first_event_term' => $report->first_event_term,
            'seriousness' => $report->seriousness,
            'report_cate' => getCommonCheckValue(true),
            'received_from_id' => $report->received_from_id,
            'status' => getCommonCheckValue(false),
            'regulation_id' => $regulation->id,
        ];
        $reportTask = $this->updateTaskData($data, $event->sourceId);

        /*设置报告规则的条件*/
        $where = [
            'id' => $reportTask->id,
        ];
        $this->setRegulationBak($regulation, $where);

        /*设置任务和报告倒计时*/
        $organizeMaps = array_flip(getRoleOrganizeMap());
        $this->setCountdown($reportTask, $organizeMaps);
    }

    /**
     * 修改报告任务数据
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onUpdateData($event)
    {
        $report = $event->report;
        $data = [
            'report_id' => $report->id,
            'report_identify' => $report->report_identifier,
            'report_first_receive_date' => $report->report_first_receive_date,
            'drug_name' => $report->drug_name,
            'first_drug_name' => $report->first_drug_name,
            'event_term' => $report->event_term,
            'first_event_term' => $report->first_event_term,
            'seriousness' => $report->seriousness,
            'report_cate' => getCommonCheckValue(true),
            'received_from_id' => $report->received_from_id,
            'status' => getCommonCheckValue(false),
        ];

        $this->updateTaskData($data, $event->sourceId);
    }

    private function updateTaskData($data, $sourceId)
    {
        /*查找报告任务*/
        $reportTask = app(ReportTaskRepository::class)->findByField('source_id', $sourceId)->first();
        /*修改报告任务*/
        return app(ReportTaskRepository::class)->update($data, $reportTask->id);
    }

    /**
     * 删除报告任务
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onDelete($event)
    {
        $sourceId = $event->sourceId;

        $where = [
            'source_id' => $sourceId,
        ];
        app(ReportTaskRepository::class)->deleteWhere($where);
    }

    /**
     * 复制报告任务
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onCopy($event)
    {
        /*报告id*/
        $reportId = $event->reportId;
        /*报告任务执行者*/
        $taskUserId = $event->taskUserId;
        /*报告规则*/
        $regulation = $event->regulation;
        /*报告首次接受日期*/
        $reportFirstReceivedData = $event->reportFirstReceivedData;
        /*新报告*/
        $newReport = $event->newReport;

        $reportTaskClone = app(ReportTaskRepository::class)->findByField('report_id', $reportId)->first()->replicate([]);

        $data = $reportTaskClone->toArray();

        /*报告id*/
        $data['report_id'] = $newReport->id;
        /*报告编号*/
        $data['report_identify'] = $newReport->report_identifier;
        /*设置任务分发时间*/
        $data['assigned_at'] = (new Carbon())->now();
        /*设置任务获悉时间*/
        $data['report_first_received_date'] = $reportFirstReceivedData;
        /*首次报告还是随访报告*/
        $data['report_cate'] = getCommonCheckValue(false);

        /*创建报告*/
        $reportTask = $this->createReportTask($data);

        /*获取报告任务执行者信息*/
        $taskUser = app(UserRepository::class)->find($taskUserId);

        /*设置报告任务的其他数据*/
        $this->setReportTaskData($reportTask, $taskUser, $regulation);
    }

    /**
     * 设置报告任务的其他数据
     * @param [type] $reportTask [description]
     * @param [type] $taskUser   [description]
     * @param [type] $regulation [description]
     */
    private function setReportTaskData($reportTask, $taskUser, $regulation)
    {
        /*设置报告任务的处理者*/
        $this->setReportTaskUserInReportTask($taskUser, $reportTask);

        /*设置报告任务的组织结构*/
        $this->initOrganizeRoleInReportTask($reportTask);

        /*设置报告规则的条件*/
        $where = [
            'id' => $reportTask->id,
        ];
        $this->setRegulationBak($regulation, $where);

        /*设置任务和报告倒计时*/
        $organizeMaps = array_flip(getRoleOrganizeMap());
        $this->setCountdown($reportTask, $organizeMaps);
    }

    public function subscribe($events)
    {
        /*设置报告任务的执行者*/
        $events->listen(
            'App\Events\Report\Task\Reassign',
            'App\Subscribes\ReportTaskEventSubscribe@onReassign'
        );

        /*原始资料分发给录入员*/
        $events->listen(
            'App\Events\Report\Task\Assign',
            'App\Subscribes\ReportTaskEventSubscribe@onAssign'
        );

        /*创建报告任务*/
        $events->listen(
            'App\Events\Report\Task\Create',
            'App\Subscribes\ReportTaskEventSubscribe@onCreate'
        );

        /*修改报告任务*/
        $events->listen(
            'App\Events\Report\Task\Update',
            'App\Subscribes\ReportTaskEventSubscribe@onUpdate'
        );

        /*修改报告任务数据*/
        $events->listen(
            'App\Events\Report\Task\UpdateData',
            'App\Subscribes\ReportTaskEventSubscribe@onUpdateData'
        );

        /*删除报告任务*/
        $events->listen(
            'App\Events\Report\Task\Delete',
            'App\Subscribes\ReportTaskEventSubscribe@onDelete'
        );

        /*复制报告任务*/
        $events->listen(
            'App\Events\Report\Task\Copy',
            'App\Subscribes\ReportTaskEventSubscribe@onCopy'
        );
    }
}
