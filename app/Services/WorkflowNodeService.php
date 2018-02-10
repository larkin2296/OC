<?php 

namespace App\Services;

use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use DataTables;
use Exception;
use DB;
use App\Repositories\Criterias\FilterCompanyIdCriteria;

class WorkflowNodeService extends Service
{
	use ServiceTrait, ResultTrait, ExceptionTrait;

	public function __construct(Builder $builder)
	{
		parent::__construct();
		$this->builder = $builder;
	}
	
	public function create()
	{
		/*通用验证*/
		$commonChecks = getCommonCheck();
		/*组织结构的值*/
		$roleOrganizes = getRoleOrganize();

		/*获取组织结构对应的角色*/
		$organizeRoleId = getRoleOrganizeValue('source_manager');
		$roles = $this->roleRepo->organizeRoles($organizeRoleId)->pluck('name', 'id_hash');

		return [
			'commonChecks' => $commonChecks,
			'roleOrganizes' => $roleOrganizes,
			'roles' => $roles,
		];
	}

	public function edit($id)
	{
		try {
			/*获取用户信息*/
			$id = $this->workflowNodeRepo->decodeId($id);
			$workflowNode = $this->workflowNodeRepo->find($id);

			/*通用验证*/
			$commonChecks = getCommonCheck();
			/*组织结构的值*/
			$roleOrganizes = getRoleOrganize();
			/*获取组织结构对应的角色*/
			$roles = $this->roleRepo->organizeRoles($workflowNode->organize_role_id)->pluck('name', 'id_hash');

			return [
				'workflowNode' => $workflowNode,
				'commonChecks' => $commonChecks,
				'roleOrganizes' => $roleOrganizes,
				'roles' => $roles,
			];
		} catch (Exception $e) {
			abort(404);
		}
	}
	
	/**
	 * 保存
	 * @return [type] [description]
	 */
	public function store()
	{
		try {
			$exception = DB::transaction(function() {
				/*不允许直接设置company信息*/
				$data = request()->except('company_id');

				/*设置默认排序 1*/
				$data['sort'] = 1;

				/*解密角色id*/
				$data['role_id'] = $this->roleRepo->decodeId($data['role_id']);

				if($workflowNode = $this->workflowNodeRepo->create($data)) {
					/*抛出设置单位的事件*/
					$companyId = getCompanyId();
					event(new \App\Events\SetCompany($workflowNode, $companyId, false));
					/*设置工作流id*/
					$workflowId = getWorkflowId();
					event(new \App\Events\WorkflowNode\SetWorkflowId($workflowNode, $workflowId));
					/*设置排序*/
					$prevNodeId = $this->workflowNodeRepo->decodeId($data['prev_node_id']);
					event(new \App\Events\WorkflowNode\Sort($prevNodeId, $workflowNode));

				} else {
					throw new Exception(trans('code/workflow.store.fail'), 2);
				}

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/workflow.store.success')
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/workflow.store.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}

	/**
	 * 修改保存
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function update($id)
	{
		try {
			$exception = DB::transaction(function() use ($id) {
				$id = $this->workflowNodeRepo->decodeId($id);

				$data = request()->except('company_id');

				/*解密角色id*/
				$data['role_id'] = $this->roleRepo->decodeId($data['role_id']);

				if( $workflowNode = $this->workflowNodeRepo->update($data, $id) ) {
					
				} else {
					throw new Exception(trans('code/workflow.update.fail'), 2);
				}

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/workflow.update.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/workflow.update.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}

	/**
	 * 删除用户
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function destroy($id)
	{
		try {
			$exception = DB::transaction(function() use ($id) {
				$id = $this->workflowNodeRepo->decodeId($id);

				if( $workflow = $this->workflowNodeRepo->delete($id) ){
				} else {
					throw new Exception(trans('code/workflow.destroy.fail'), 2);
				}

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/workflow.destroy.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/workflow.destroy.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}

	/**
	 * 排序
	 * @return [type] [description]
	 */
	public function sort()
	{
		try {
			$exception = DB::transaction(function() {

				$prevNodeId = $this->workflowNodeRepo->decodeId(request('prev_node_id', 0));
				$curNodeId = $this->workflowNodeRepo->decodeId(request('cur_node_id', 0));

				$curNode = $this->workflowNodeRepo->find($curNodeId);

				/*设置排序*/
				event(new \App\Events\WorkflowNode\Sort($prevNodeId, $curNode));

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/workflow.store.success')
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/workflow.store.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}
}