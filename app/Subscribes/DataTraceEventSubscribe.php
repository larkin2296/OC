<?php

namespace App\Subscribes;

use App\Repositories\Interfaces\DataTraceRepository;
use App\Repositories\Interfaces\ReportMainpageRepository;
use App\Repositories\Interfaces\UserRepository;

class DataTraceEventSubscribe
{   
    /**
     * 添加稽查数据
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onReportValueCreate($event)
    {
        $oldValues = $event->oldValues;
        $newValues = $event->newValues;
        $attributes = $event->attributes;
        $reportId = $event->reportId;
        $userId = $event->userId;

        /*获取报告对象*/
        $report = app(ReportMainpageRepository::class)->find($reportId);
        /*获取用户对象*/
        $user = app(UserRepository::class)->find($userId);

        /*老数据*/
        $oldValues = $this->mapGroupValues($oldValues);
        /*新数据*/
        $newValues = $this->mapGroupValues($newValues);

        /*删除数据对象*/
        $deleteValues = [];
        /*处理修改数据--痕迹*/
        foreach($oldValues as $oldKey => $oldValue) {
            if( isset($newValues[$oldKey]) && $tempNewValue=$newValues[$oldKey] ) {
                if( $tempNewValue['value'] != $oldValue['value'] ) {
                    /*痕迹管理--修改*/
                    $data = array_merge($attributes, [
                        'field' => $oldValue['name'],
                        'old_value' => $oldValue['value'],
                        'new_value' => $tempNewValue['value'],
                        'action_status' => '修改',
                    ]);
                    $this->createTrace($data, $report, $user);
                }
                unset($newValues[$oldKey]);
            } else {
                /*数据点被删除*/
                $deleteValues[$oldKey] = $oldValue;
            }
        }

        /*处理新加数据--痕迹*/
        foreach( $newValues as $newValue ) {
            /*痕迹管理 -- 增加*/
            $data = array_merge($attributes, [
                'field' => $newValue['name'],
                'old_value' => '',
                'new_value' => $newValue['value'],
                'action_status' => '增加',
            ]);
            $this->createTrace($data, $report, $user);
        }

        /*处理删除数据--痕迹*/
        foreach( $deleteValues as $deleteValue ) {
            /*痕迹管理 -- 删除*/
            $data = array_merge($attributes, [
                'field' => $newValue['name'],
                'old_value' => $deleteValue['value'],
                'new_value' => '',
                'action_status' => '删除',
            ]);
            $this->createTrace($data, $report, $user);
        }
    }

    private function mapGroupValues($values)
    {
        return $values->mapWithKeys(function($item, $key) {
            $key = $item['report_id'] . $item['report_tab_id'] . $item['col'] . $item['table_alias'] . $item['table_row_id'] . $item['name'];
            return [ 
                $key => $item,
            ];
        })->toArray();
    }

    /**
     * 创建事件稽查数据
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onEventCreate($event)
    {
        $attributes = $event->attributes;
        $user = $event->user;
        $report = $event->report;

        /*痕迹管理--修改*/
        $attributes = array_merge($attributes, [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $report->role_organize_status,
            'report_id' => $report->id,
            'report_identify' => $report->report_identifier,
        ]);
        return app(DataTraceRepository::class)->create($attributes);
    }

    /**
     * 添加痕迹管理数据
     * @param  [type] $attributes [description]
     * @param  [type] $report     [description]
     * @param  [type] $user       [description]
     * @return [type]             [description]
     */
    private function createTrace($attributes, $report, $user)
    {
        /*痕迹管理--修改*/
        $attributes = array_merge($attributes, [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $report->role_organize_status,
            'report_id' => $report->id,
            'report_identify' => $report->report_identifier,
        ]);
        return app(DataTraceRepository::class)->create($attributes);
    }

    public function subscribe($events)
    {
        /*创建数据稽查数据*/
        $events->listen(
            'App\Events\DataTrace\ReportValueCreate',
            'App\Subscribes\DataTraceEventSubscribe@onReportValueCreate'
        );

        /*创建事件稽查数据*/
        $events->listen(
            'App\Events\DataTrace\EventCreate',
            'App\Subscribes\DataTraceEventSubscribe@onEventCreate'
        );
    }
}
