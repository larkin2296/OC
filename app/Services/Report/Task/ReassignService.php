<?php 

namespace App\Services\Report\Task;

use App\Services\Service;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use Exception;
use DB;
use App\Traits\Services\Workflow\WorkflowTrait;

class ReassignService extends Service
{
	use ServiceTrait, ResultTrait, ExceptionTrait;
	use WorkflowTrait;

	public function index($id)
	{
		try {
			$reportTaskId = $this->reportTaskRepo->decodeId($id);
			$reportTask = $this->reportTaskRepo->find($reportTaskId);

			/*获取当前用户的组织角色id*/
			$organizeRoleId = $reportTask->organize_role_id;

			/*获取公司*/
			$companyId = getCompanyId();
			$taskUsers = $this->curNodeUsers($organizeRoleId, $companyId);

			return [
				'reportTask' => $reportTask,
				'taskUsers' => $taskUsers
			];
		} catch (Exception $e) {
			dd($e);
			abort(404);
		}
	}

	/**
	 * 报告任务重新分发
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function store($id)
	{
		try {
			$exception = DB::transaction(function() use ($id) {
				/*获取分发的任务者id*/
				$taskUserId = request('task_user_id');
				/*报告任务*/
				$reportTaskId = $this->reportTaskRepo->decodeId($id);
				$taskUserId = $this->checkParamValue($this->userRepo->decodeId($taskUserId), 0, true);

				$reportTask = $this->reportTaskRepo->find($reportTaskId);

				event(new \App\Events\Report\Task\Reassign($taskUserId, $reportTask));

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/report.task.reassign.store.success')
				]);
			});
		} catch (Exception $e) {
			dd($e);
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/report.task.reassign.store.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}
}