<?php 

namespace App\Traits\Services\Report;
use App\Repositories\Interfaces\ReportTaskRepository;

Trait TaskTrait
{
	/**
	 * 设置任务和报告倒计时
	 * @param [type] $reportTask   [description]
	 * @param [type] $organizeMaps [description]
	 */
	public function setCountdown($reportTask, $organizeMaps)
	{
        /*重新获取报告任务*/
        $reportTask = app(ReportTaskRepository::class)->find($reportTask->id);
        
		$organizeRoleId = $reportTask->organize_role_id;
        $taskCompleteCountdownKey = $organizeMaps[$organizeRoleId] . '_countdown';
        $taskCompleteCountdown = $reportTask->{$taskCompleteCountdownKey};
        /*报告完成的时间*/
        $reportCompleteCountdown = $reportTask->report_complete_countdown;

        $assignedAt = $reportTask->assigned_at;
        $knowdedAt = $reportTask->report_first_received_date;

        switch( $reportTask->countdown_unit ) {
            case 'd' :
                /*任务倒计时*/
                $taskCountdown = $assignedAt->addDays($taskCompleteCountdown);
                /*报告倒计时*/
                $reportCountdown = $knowdedAt->addDays($reportCompleteCountdown);
            
                break;
            case 'h' :
                /*任务倒计时*/
                $taskCountdown = $assignedAt->addHours($taskCompleteCountdown);
                /*报告倒计时*/
                $reportCountdown = $knowdedAt->addHours($reportCompleteCountdown);
                break;

            default :
                /*任务倒计时*/
                $taskCountdown = $assignedAt;
                /*报告倒计时*/
                $reportCountdown = $knowdedAt;
        }

        $reportTask->task_countdown = $taskCountdown;
        $reportTask->report_countdown = $reportCountdown;
        $reportTask->save();
	}

    /**
     * 设置报告规则的冗余数据
     */
    public function setRegulationBak($regulation, $where = [])
    {
        /*
            修改报告中的报告规则的倒计时时间
         */
        $data = [
            'data_insert_countdown' => $regulation->data_insert,
            'data_qc_countdown' => $regulation->data_qc,
            'medical_exam_countdown' => $regulation->medical_exam,
            'medical_exam_qc_countdown' => $regulation->medical_exam_qc,
            'report_submit_countdown' => $regulation->report_submit,
            //报告完成倒计时
            'report_complete_countdown' => $regulation->finished_date,
            /*报告规则倒计时单位*/
            'countdown_unit' => $regulation->unit,
        ];

        $where = array_merge($where, [
            'regulation_id' => $regulation->id,
        ]);

        app(ReportTaskRepository::class)->updateWhere($data, $where);
    }
}