<?php 

namespace App\Services;

use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use DataTables;
use Exception;
use DB;

class PermissionService extends Service
{
	use ServiceTrait, ResultTrait, ExceptionTrait;

	public function __construct(Builder $builder)
	{
		parent::__construct();
		$this->builder = $builder;
	}
	
	/**
	 * 列表
	 * @return [type] [description]
	 */
	public function index()
	{
	    $html = $this->builder->columns([
            // ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'name', 'name' => 'name', 'title' => '权限名'],
            ['data' => 'display_name', 'name' => 'display_name', 'title' => '权限展示名'],
            ['data' => 'description', 'name' => 'description', 'title' => '描述'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => '创建时间'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => '修改时间'],
            ['data' => 'action', 'name' => 'action', 'title' => '操作', 'class' => 'text-center', 'sorting' => false],
        ])
       	->ajax([
			'url' => route('admin.permission.index'),
		    'type' => 'GET',
       	])->parameters(config('back.datatables-cfg.basic'));

	    return [
	    	'html' => $html
	    ];
	}

	/**
	 * 列表数据
	 * @return [type] [description]
	 */
	public function datatables()
	{
		$data = $this->permissionRepo->all();
        return DataTables::of($data)
        			->editColumn('id', '{{ $id_hash }}')
        			->addColumn('action', getThemeTemplate('back.system.permission.datatable'))
	        		->make();
	}

	/**
	 * 权限保存
	 * @return [type] [description]
	 */
	public function store()
	{
		try {
			$exception = DB::transaction(function() {
				$data = request()->all();
				if( $permission = $this->permissionRepo->create($data) ) {

				} else {
					throw new Exception(trans('code/permission.store.fail'), 2);
				}

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/permission.store.success')
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/permission.store.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}

	/**
	 * 权限修改
	 * @param  [type] $id [权限id]
	 * @return [type]     [description]
	 */
	public function edit($id)
	{
		try {
			/*获取权限信息*/
			$id = $this->permissionRepo->decodeId($id);
			$permission = $this->permissionRepo->find($id);

			return [
				'permission' => $permission,
			];
		} catch (Exception $e) {
			abort(404);
		}
	}

	/**
	 * 权限修改保存
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function update($id)
	{
		try {
			$exception = DB::transaction(function() use ($id) {
				$data = request()->all();

				$id = $this->permissionRepo->decodeId($id);
				if($this->permissionRepo->update($data, $id)) {

				} else {
					throw new Exception(trans('code/permission.update.fail'), 2);
				}
				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/permission.update.success')
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/permission.update.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}

	/**
	 * 删除权限
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function destroy($id)
	{
		try {
			$exception = DB::transaction(function() use ($id) {
				$id = $this->permissionRepo->decodeId($id);

				if($this->permissionRepo->delete($id)) {

				} else {
					throw new Exception(trans('code/permission.destroy.fail'), 2);
				}
				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/permission.destroy.success')
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/permission.destroy.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}
}