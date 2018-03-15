<?php

namespace App\Subscribes;

use  App\Repositories\Interfaces\ReportValuesRepository;

class ReportValueEventSubscribe
{   
    /*清除表格数据*/
    public function onClearTableData($event)
    {
        $companyId = $event->companyId;
        $reportId = $event->reportId;
        $reportTabId = $event->reportTabId;

        // app(ReportValuesRepository::class)->clearTableData($reportId, $reportTabId);
        $where = [
            'company_id' => $companyId,
            'report_id' => $reportId,
            'report_tab_id' => $reportTabId,
        ];
        
        app(ReportValuesRepository::class)->forceDeleteWhere($where);
    }

    /**
     * 创建报告详情的数据
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onCreate($event)
    {
        /*报告数据*/
        $report = $event->report;


        /*设置报告详情数据除了概览页面*/
        $tabFields = getReportRedundanceField();
        $this->setReportValueData($tabFields, $report);

        /*设置报告详情概览界面*/
        $reportValueFields = getReportValueRedundanceField();
        $this->setReportValueData($reportValueFields, $report);

        /*设置报告概览基本信息*/
        $this->setInitReportValueIn($report, 'report_identify', $report->report_identifier);
        $this->setInitReportValueIn($report, 'report_cate', $report->is_first_report);
        $this->setInitReportValueIn($report, 'created_at', $report->created_at);
    }

    /*设置报告详情数据*/
    private function setReportValueData($tabFields, $report)
    {
        /*获取报告的冗余字段*/
        if( $tabFields ) {
            /*遍历*/
            foreach($tabFields as $tabIdentify => $tabField) {
                $reportTabId = getReportTabValue($tabIdentify);
                if( is_array($tabFields) ) {
                    /*药物信息*/
                    $drug = getReportTabValue('drug');
                    /*不良*/
                    $event = getReportTabValue('event');
                    /*基础信息*/
                    $basic = getReportTabValue('basic');

                    /*属性*/    
                    $attributes = [
                        'company_id' => $report->company_id,
                        'report_id' => $report->id,
                        'report_tab_id' => $reportTabId,
                        'col' => 0,
                        'col_name' => '',
                        'is_table' => getCommonCheckValue(false),
                        'table_alias' => 0,
                        'table_row_id' => 0,
                    ];
                    switch($tabIdentify) {
                        /*药物*/
                        case $drug :
                            $attributes = array_merge($attributes, [
                                'col' => 1,
                                'col_name' => $report->brand_name,
                            ]);
                            break;

                        /*事件*/
                        case $event :  
                            $attributes = array_merge($attributes, [
                                'col' => 1,
                                'col_name' => $report->event_term,
                            ]); 
                            break;

                    }

                    foreach($tabField as $field => $position) {
                        /*重置关于table的数据*/
                        $attributes = array_merge($attributes, [
                            'is_table' => getCommonCheckValue(false),
                            'table_alias' => 0,
                            'table_row_id' => 0,
                        ]);
                        if( $position == 'table_first' ) {
                            $attributes = array_merge($attributes, [
                                'is_table' => getCommonCheckValue(true),
                                'table_alias' => 1,
                                'table_row_id' => 1,
                            ]);
                        }

                        /*存在回写数据，并且数据存在*/
                        if( isset($report->{$field}) && $value = $report->{$field} ) {
                            
                            $data = array_merge($attributes, [
                                'name' => $field,
                                'value' => $value,
                            ]);

                            app(ReportValuesRepository::class)->create($data);
                        }
                    }
                }
            }
        }
    }

    /**
     * 设置报告详情初始化数据
     * @param [type] $report [description]
     * @param [type] $field  [description]
     * @param [type] $value  [description]
     */
    private function setInitReportValueIn($report, $field, $value)
    {
        $attributes = [
            'company_id' => $report->company_id,
            'report_id' => $report->id,
            'report_tab_id' => getReportTabValue('overview'),
            'col' => 0,
            'col_name' => '',
            'is_table' => getCommonCheckValue(false),
            'table_alias' => 0,
            'table_row_id' => 0,
            'name' => $field,
        ];
        $data = [
            'value' => $value,
        ];
        app(ReportValuesRepository::class)->updateOrCreate($attributes, $data);
    }

    /**
     * 复制报告详情数据
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onCopy($event)
    {
        $reportId = $event->reportId;
        $newReport = $event->newReport;

        $reportValues = app(ReportValuesRepository::class)->findByField('report_id', $reportId);
        if( $reportValues->isNotEmpty() ) {
            foreach( $reportValues as $reportValue ) {
                $data = $reportValue->replicate()->toArray();
                $data['report_id'] = $newReport->id;
                
                app(ReportValuesRepository::class)->create($data);
            }
        }

        /*设置报告概览基本信息*/
        $this->setInitReportValueIn($newReport, 'report_identify', $newReport->report_identifier);
    }

    public function subscribe($events)
    {
        /*清除报告详情中-table数据*/
        $events->listen(
            'App\Events\Report\Value\ClearTableData',
            'App\Subscribes\ReportValueEventSubscribe@onClearTableData'
        );

        /*创建数据*/
        $events->listen(
            'App\Events\Report\Value\Create',
            'App\Subscribes\ReportValueEventSubscribe@onCreate'
        );

        /*复制数据*/
        $events->listen(
            'App\Events\Report\Value\Copy',
            'App\Subscribes\ReportValueEventSubscribe@onCopy'
        );
    }
}
