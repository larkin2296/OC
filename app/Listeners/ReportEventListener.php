<?php

namespace App\Listeners;

use App\Events\Report\Main\PushReportEvent;
use App\Repositories\Interfaces\ReportMainpageRepository;
use App\Repositories\Models\ReportMainpage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Traits\Services\Report\MainTrait;

class ReportEventListener
{
    use MainTrait;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  PushReportEvent  $event
     * @return void
     */
    public function handle(PushReportEvent $event)
    {
        //报告编号
        $report_identifier = $event->report_identifier;
        //接受报告时间
        $report_first_received_date = $event->report_first_received_date;
        //pv部门报告时间
        $report_drug_safety_date = $event->report_drug_safety_date;
        //创建新版本的原因
        $create_version_cause = $event->create_version_cause;
        /*当前单位id*/
        $companyId = $event->companyId;
        /*原始资料id*/
        $sourceId = $event->sourceId;

        /*获取用户*/
        $user = getUser();
        /*用户id*/
        $user_id = $user->id;
        /*用户所在的公司*/
        $company = $user->company;

        $company_id = $this->getReportCompanyId($report_identifier);

        $report = $this->getReportValue($company,$user_id,$company_id,$report_first_received_date,$report_drug_safety_date,$create_version_cause);

        $newReport = $this->createReportInformation($report);

        /*更改报告任务数据*/
        event(new \App\Events\Report\Task\UpdateData($newReport, $companyId, $sourceId));
        /*复制报告详情数据*/
        event(new \App\Events\Report\Value\Copy($report['id'], $newReport));
    }

    public function getReportCompanyId($report_identifier)
    {
        return app(ReportMainpageRepository::class)->findWhere(['report_identifier'=>$report_identifier])->pluck('company_id');
    }

    public function getReportValue($company,$user_id,$company_id,$report_first_received_date,$report_drug_safety_date,$create_version_cause)
    {
        //当前所有的编号
        $reportSome = $this->getReportIdentifier($company_id);

        foreach($reportSome as $key=>$item){

            if(substr($item,0,strrpos($item,'-'))){

                $id = app(ReportMainpageRepository::class)->findWhere(['report_identifier'=>$item])->first()->id;
            } else {
                $id = $key;
            }
        }
        $company_now_id = $company->id;

        $report = $this->getReportCommonAll($id);

        $reportFinally = $this->finallyReportCheck($report,$user_id,$company_now_id,$report_first_received_date,$report_drug_safety_date,$create_version_cause);

        return $reportFinally;
    }

    public function getReportIdentifier($company_id)
    {
        return app(ReportMainpageRepository::class)->findWhere(['company_id'=>$company_id])->pluck('report_identifier', 'id');
    }
    public function getReportCommonAll($id)
    {
       return app(ReportMainpageRepository::class)->find($id)->toArray();
    }
    public function finallyReportCheck($report,$user_id,$company_now_id,$report_first_received_date,$report_drug_safety_date,$create_version_cause)
    {
        //更新数据
        $report['user_id'] = $user_id;  /*用户*/
        $versionName = $this->getEdition($report['report_identifier'],$company_now_id); /*版本编号*/
        $report['report_identifier'] = $versionName;
        $report['report_first_received_date'] = $report_first_received_date;/*报告时间*/
        $report['report_drug_safety_date'] = $report_drug_safety_date;/*pv报告时间*/
        $report['create_version_cause'] = $create_version_cause;/*创建原因*/
        $report['report_identifier_status']=1;/*更新新增数据状态*/
        return $report;
    }

    public function createReportInformation($report)
    {
        return app(ReportMainpageRepository::class)->create($report);
    }
}
