<?php 

namespace App\Services;

use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use App\Traits\Services\Permission\PermissionTrait;
use DataTables;
use Exception;
use DB;

class RoleService extends Service
{
	use ServiceTrait, ResultTrait, ExceptionTrait, PermissionTrait;

	public function __construct(Builder $builder)
	{
		parent::__construct();
		$this->builder = $builder;
	}
	
	public function index()
	{
	    $html = $this->builder->columns([
            // ['data' => 'id', 'name' => 'id', 'title' => '角色ID', 'class' => 'text-center'],
            ['data' => 'name', 'name' => 'name', 'title' => '角色名'],
            ['data' => 'display_name', 'name' => 'display_name', 'title' => '展示名'],
            ['data' => 'description', 'name' => 'description', 'title' => '描述'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => '创建时间'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => '修改时间'],
            ['data' => 'action', 'name' => 'action', 'title' => '操作', 'class' => 'text-center', 'sorting' => false],
        ])
       	->ajax([
			'url' => route('admin.role.index'),
		    'type' => 'GET',
       	])->parameters(config('back.datatables-cfg.basic'));

	    return [
	    	'html' => $html
	    ];
	}

	public function datatables()
	{
		$data = $this->roleRepo->all();
        return DataTables::of($data)
        			->editColumn('id', '{{ $id_hash }}')
        			->addColumn('action', getThemeTemplate('back.system.role.datatable'))
	        		->make();
	}

	public function create()
	{
		try {
			/*组织结构的值*/
			$roleOrganizes = getRoleOrganize();

			return [
				'roleOrganizes' => $roleOrganizes,
			];
		} catch (Exception $e) {
			abort(404);
		}
	}
	
	public function edit($id)
	{
		try {
			/*获取用户信息*/
			$id = $this->roleRepo->decodeId($id);
			$role = $this->roleRepo->find($id);

			/*组织结构的值*/
			$roleOrganizes = getRoleOrganize();

			return [
				'roleOrganizes' => $roleOrganizes,
				'role' => $role,
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
				if($role = $this->roleRepo->create(request()->all())) {
					
				} else {
					throw new Exception(trans('code/role.store.fail'), 2);
				}

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/role.store.success')
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/role.store.fail')),
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
				$id = $this->roleRepo->decodeId($id);

				if( $role = $this->roleRepo->update(request()->all(), $id) ) {
				} else {
					throw new Exception(trans('code/role.update.fail'), 2);
				}

				/*清除菜单缓存*/
				event(new \App\Events\FlushCache());

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/role.update.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/role.update.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}

	/**
	 * 删除角色
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function destroy($id)
	{
		try {
			$exception = DB::transaction(function() use ($id) {
				$id = $this->roleRepo->decodeId($id);

				if( $role = $this->roleRepo->delete($id) ){

				} else {
					throw new Exception(trans('code/role.destroy.fail'), 2);
				}

				/*清除菜单缓存*/
				event(new \App\Events\FlushCache());

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/role.destroy.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/role.destroy.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}

	/**
	 * 角色用户
	 * @return [type] [description]
	 */
	public function userShow($id)
	{
		$results = [];

		try {
			/*获取用户信息*/
			$id = $this->roleRepo->decodeId($id);
			$role = $this->roleRepo->find($id);

			$users = $role->users->map(function($item, $key) {
				return [
					'name' => $item->name,
					'company_name' => $item->company_name,
				];
			});

			$results = [
				'role' => $role,
				'data' => $users,
			];
		} catch (Exception $e) {
			$results = [
				'role' => $role,
				'data' => []
			];
		}

		return $results;
	}

	/**
	 * 角色权限列表
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function permissionEdit($id)
	{
		try {
			/*角色权限*/
			$id = $this->roleRepo->decodeId($id);
			$role = $this->roleRepo->find($id);
			$rolePermissions = $role->permissions->keyBy('name')->keys()->toArray();

			/*获取所有权限并且表明已选择的*/
			$permissionSelected = $this->permissionSelect($rolePermissions);

			$results = [
				'role' => $role,
				'data' => $permissionSelected
			];
		} catch (Exception $e) {
			$results = [
				'role' => $role,
				'data' => []
			];
		}

		return $results;
	}

	/**
	 * 角色权限保存
	 * @return [type] [description]
	 */
	public function permissionUpdate($id)
	{
		try {
			$exception = DB::transaction(function() use ($id) {
				/*获取角色信息*/
				$id = $this->roleRepo->decodeId($id);
				$role = $this->roleRepo->find($id);
				
				/*角色绑定权限*/
				$permissionIds = $this->checkParam('permission', [], false);
				event(new \App\Events\Role\BindPermission($role, $permissionIds));

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/role.permission.update.success')
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/role.permission.update.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}

	/**
	 * 组织结构角色
	 * @return [type] [description]
	 */
	public function organize($organizeRoleId)
	{
		$results = [];

		try {
			/*获取组织结构对应的角色*/
			$roles = $this->roleRepo->organizeRoles($organizeRoleId)->map(function($item, $key) {
				return [
					'id' => $item->id_hash,
					'name' => $item->name,
				];
			});

			$results = array_merge($this->results, [
				'result' => true,
				'data' => $roles,
				'message' => trans('code/role.organize.success'),
			]);
		} catch (Exception $e) {
			$results = array_merge($this->results, [
				'result' => false,
				'data' => $this->handler($e, trans('code/role.organize.fail')),
			]);
		}

		return array_merge($this->results, $results);
	}

}