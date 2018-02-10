<?php 

namespace App\Services\Report\Task;

use App\Services\Service;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use Exception;
use DB;

class NewVersionService extends Service
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

			$source = $this->sourceRepo->find($reportTask->source_id);

			return [
				'reportTask' => $reportTask,
				'source' => $source
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
				$taskId = $this->reportTaskRepo->decodeId($id);
				$task = $this->reportTaskRepo->find($taskId);

				/*报告编号*/
				$reportIdentify = $this->checkParam('report_identify', '');
				$reportFirstReceivedDate = $this->checkParam('report_first_received_date', '');
				$reportDrugSafetyDate = $this->checkParam('report_drug_safety_date', '');
				$newVersionReason = $this->checkParam('new_version_reason', '');

				/*公司id*/
				$companyId = getCompanyId();
				$sourceId = $task->source_id;

				/*调用创建新版本*/
				event(new \App\Events\Report\Main\PushReportEvent($reportIdentify,$reportFirstReceivedDate,$reportDrugSafetyDate, $newVersionReason, $sourceId, $companyId));

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/report.task.newversion.store.success')
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/report.task.newversion.store.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}
}