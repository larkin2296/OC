<?php

namespace App\Traits\Services\Report;
use App\Repositories\Interfaces\ReportMainpageRepository;

Trait MainTrait{
    /*生成编号规则*/
    public function getReportNumber($companyName,$companyId)
    {
        $language = app('pinyin');
        $companies = strtoupper(pinyin_abbr($companyName));
        $times = date('Y',time());
        $information = $this->getNumber($companies,$times,$companyId);
        return $information;
    }
    protected function getNumber($company,$times,$companyId)
    {
        $num = '000001';

        $device_name = $times.$company;

        $initial = $device_name.$num;
//        ReportMainpageRepository::class
        if ($report_num = app(ReportMainpageRepository::class)->findWhere(['company_id'=>$companyId,'report_identifier_status'=>0])->pluck('report_identifier')->all()) {

            $report_identifier = app(ReportMainpageRepository::class)->findWhere(['company_id'=>$companyId,'report_identifier_status'=>0])->count()+1;

            $report_identifier_len = strlen($report_identifier);

            $new_report_identifier =  substr($initial,0,-$report_identifier_len);

            $report_num = $new_report_identifier.$report_identifier;

            return $report_num;

        }else {

          return  $initial;

        }

    }
    /*新建版本号*/
    protected function getEdition($report_identifier,$company_id)
    {
       $num = '-001';

       $initial = $report_identifier.$num;

       if($report_num = app(ReportMainpageRepository::class)->findWhere(['company_id'=>$company_id,'report_identifier_status'=>1])->pluck('report_identifier')->all()) {

           $report_version= app(ReportMainpageRepository::class)->findWhere(['company_id'=>$company_id,'report_identifier_status'=>1])->count()+1;

           $report_identifier_len = strlen($report_version);

           $new_report_identifier =  substr($initial,0,-$report_identifier_len);

           $new_report_identifier = explode('-',$new_report_identifier);
           unset($new_report_identifier[2]);
           $report_num=implode('-',$new_report_identifier);
           $new_report_identifier =  substr($report_num,0,-$report_identifier_len);

//           if($new_report_identifier)
//           $report_num = strrpos($new_report_identifier,'-');
           $report_num = $new_report_identifier.$report_version;

           return $report_num;

       }else {

           return  $initial;

       }


    }
}