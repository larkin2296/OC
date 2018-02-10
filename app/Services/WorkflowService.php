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
use App\Repositories\Criterias\OrderBySortCriteria;

class WorkflowService extends Service
{
	use ServiceTrait, ResultTrait, ExceptionTrait;

	public function __construct(Builder $builder)
	{
		parent::__construct();
		$this->builder = $builder;
	}
	
	public function index()
	{
	    $html = $this->builder->columns([
            // ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'name', 'name' => 'name', 'title' => '名称'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => '创建时间'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => '修改时间'],
            ['data' => 'status', 'name' => 'status', 'title' => '是否有效'],
            ['data' => 'is_use', 'name' => 'is_use', 'title' => '是否默认'],
            ['data' => 'action', 'name' => 'action', 'title' => '操作', 'class' => 'text-center', 'sorting' => false],
        ])
       	->ajax([
			'url' => route('admin.workflow.index'),
		    'type' => 'GET',
       	])->parameters(config('back.datatables-cfg.basic'));

	    return [
	    	'html' => $html
	    ];
	}

	public function datatables()
	{

		$companyId = getCompanyId();

		$this->workflowRepo->pushCriteria(new FilterCompanyIdCriteria($companyId));
		$data = $this->workflowRepo->all(['id', 'name', 'created_at', 'updated_at', 'status', 'is_use']);

        return DataTables::of($data)
        			->editColumn('id', '{{$id_hash}}')
        			->editColumn('status', '{{ getCommonCheckShowValue($status, "有效", "无效") }}')
        			->editColumn('is_use', getThemeTemplate('back.system.workflow.is_use'))
        			->addColumn('action', getThemeTemplate('back.system.workflow.datatable'))
	        		->make();
	}

	public function create()
	{
		/*通用验证*/
		$commonChecks = getCommonCheck();

		return [
			'commonChecks' => $commonChecks,
		];
	}

	public function edit($id)
	{
		try {
			/*获取用户信息*/
			$id = $this->workflowRepo->decodeId($id);
			$workflow = $this->workflowRepo->find($id);
			/*通用验证*/
			$commonChecks = getCommonCheck();

			return [
				'workflow' => $workflow,
				'commonChecks' => $commonChecks,
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

				if($workflow = $this->workflowRepo->create($data)) {
					/*抛出设置单位的事件*/
					$companyId = getCompanyId();
					event(new \App\Events\SetCompany($workflow, $companyId));

					/*如果此工作是正常，则停用其他工作流*/
					if($workflow->is_use == getCommonCheckValue(true)) {
						/*停用此公司下所有工作流*/
						$companyId = getCompanyId();
						event(new \App\Events\Workflow\CloseWorkflow($companyId));

						/*启用工作流*/
						event(new \App\Events\Workflow\OpenWorkflow($companyId, $workflow->id));
					}

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
				$id = $this->workflowRepo->decodeId($id);

				if( $workflow = $this->workflowRepo->update(request()->all(), $id) ) {
					/*如果此工作是正常，则停用其他工作流*/
					if($workflow->is_use == getCommonCheckValue(true)) {
						/*停用此公司下所有工作流*/
						$companyId = getCompanyId();
						event(new \App\Events\Workflow\CloseWorkflow($companyId));

						/*启用工作流*/
						event(new \App\Events\Workflow\OpenWorkflow($companyId, $workflow->id));
					}
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
				$id = $this->workflowRepo->decodeId($id);

				if( $workflow = $this->workflowRepo->delete($id) ){
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
     * 工作流配置
     * @return [type] [description]
     */
	public function setting($id)
	{
		try {
			$workflowId = $this->workflowRepo->decodeId($id);
			$workflow = $this->workflowRepo->find($workflowId);

			event(new \App\Events\Workflow\SetWorkflowId($workflow->id));

			$companyId = getCompanyId();

			$where = [
				'workflow_id' => $workflow->id,
				'company_id' => $companyId,
			];

			$this->workflowNodeRepo->pushCriteria(new OrderBySortCriteria('asc'));
			$workflowNodes = $this->workflowNodeRepo->findWhere($where);

			return [
				'workflowIdHash' => $workflowId,
				'workflowNodes' => $workflowNodes
			];
		} catch (Exception $e) {
			abort(404);
		}
	}

	/**
	 * 启用工作流
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function open($id)
	{
		try {
			$exception = DB::transaction(function() use ($id) {
				$id = $this->workflowRepo->decodeId($id);

				/*停用此公司下所有工作流*/
				$companyId = getCompanyId();
				event(new \App\Events\Workflow\CloseWorkflow($companyId));

				/*启用工作流*/
				event(new \App\Events\Workflow\OpenWorkflow($companyId, $id));
				
				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/workflow.open.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/workflow.open.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}
}