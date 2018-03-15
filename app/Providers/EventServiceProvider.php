<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        'App\Subscribes\UserEventSubscribe',
        'App\Subscribes\RoleEventSubscribe',
        'App\Subscribes\MenuEventSubscribe',
        'App\Subscribes\WorkflowEventSubscribe',
        'App\Subscribes\WorkflowNodeEventSubscribe',
        'App\Subscribes\ReportTaskEventSubscribe',
        'App\Subscribes\ReportValueEventSubscribe',
        'App\Subscribes\DataTraceEventSubscribe',
    ];
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        /*清除缓存*/
        'App\Events\FlushCache' => [
            'App\Listeners\FlushCacheListener',
        ],

        /*设置 数据表company_id, company_name*/
        'App\Events\SetCompany' => [
            'App\Listeners\SetCompanyListener',
        ],

        /*修改报告任务中的报告规则*/
        'App\Events\Regulation\Update' => [
            'App\Listeners\Regulation\UpdateListener',
        ],
        /*创建新版本*/
        'App\Events\Report\Main\PushReportEvent'=>[
          'App\Listeners\ReportEventListener',
        ],

        /*修改报告任务冗余数据*/
        'App\Events\Report\Task\SetRedundanceData' => [
            'App\Listeners\Report\Task\SetRedundanceDataListener',
        ],

        /*修改报告详情冗余数据*/
        'App\Events\Report\Value\SetRedundanceData' => [
            'App\Listeners\Report\Value\SetRedundanceDataListener',

        ],
        /*修改报告主页面的冗余数据*/
        'App\Events\Report\Value\SetReportMainData' => [
            'App\Listeners\Report\Value\SetReportMainDataListener',

        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
