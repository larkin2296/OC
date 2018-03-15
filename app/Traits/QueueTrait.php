<?php 
/*队列执行*/

namespace App\Traits;

use Exception;

Trait QueueTrait
{
	/**
	 * 运行规则事件
	 * @return [type] [description]
	 */
	public function runRugulationUpdate($regulation)
	{
		event(new \App\Events\Regulation\Update($regulation));
	}

	/**
	 * 设置报告任务的冗余数据
	 * @return [type] [description]
	 */
	public function runSetReportTaskRedundanceData($companyId, $reportId, $data)
	{
		event(new \App\Events\Report\Task\SetRedundanceData($companyId, $reportId, $data));
	}

	/**
	 * 设置报告主页面的冗余数据
	 * @param  [type] $companyId [description]
	 * @param  [type] $reportId  [description]
	 * @param  [type] $data      [description]
	 * @return [type]            [description]
	 */
	public function runSetReportRedundanceData($companyId, $reportId, $data)
	{
        event(new \App\Events\Report\Task\SetReportMainData($companyId, $reportId, $data));
	}
}