<?php 

namespace App\Services\Report\Task;

use App\Services\Service;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use Exception;
use DB;

class RelevanceService extends Service
{
	use ServiceTrait, ResultTrait, ExceptionTrait;

	/**
	 * 报告任务-创建新版本
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function index($id)
	{
		try {
			$reportTaskId = $this->reportTaskRepo->decodeId($id);
			$reportTask = $this->reportTaskRepo->find($reportTaskId);

			return [
				'reportTask' => $reportTask,
			];
		} catch (Exception $e) {
			abort(404);
		}
	}

	/**
	 * 报告任务-保存新版本
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function store($id)
	{
		try {
			$exception = DB::transaction(function() use ($id) {
				/*报告编号*/
				$reportIdentify = $this->checkParam('report_identify');

				/*获取数据*/
				$data = reqeust()->all();

				/*调用创建新版本*/

				/*创建稽查痕迹*/
				event(new \App\Events\Inspect\Create());

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/report.task.reassign.store.success')
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/report.task.reassign.store.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}
}