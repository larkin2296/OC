<?php 

namespace App\Services;

use Yajra\DataTables\Html\Builder;
use App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use DataTables;
use Exception;
use DB;

class UserService extends Service
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
            // ['data' => 'id', 'name' => 'id', 'title' => '用户ID'],
            ['data' => 'name', 'name' => 'name', 'title' => '用户名'],
            ['data' => 'email', 'name' => 'email', 'title' => '邮箱'],
            ['data' => 'status', 'name' => 'status', 'title' => '状态', 'class' => 'text-center'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => '创建时间'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => '修改时间'],
            ['data' => 'action', 'name' => 'action', 'title' => '操作', 'class' => 'text-center', 'sorting' => false],
        ])
       	->ajax([
			'url' => route('admin.user.index'),
		    'type' => 'GET',

       	])->parameters(config('back.datatables-cfg.basic'));


	    return [
	    	'html' => $html
	    ];
	}

	public function datatables()
	{
		$data = $this->userRepo->all(['id', 'name', 'email', 'created_at', 'updated_at', 'status']);

        return DataTables::of($data)
        			->editColumn('id', '{{$id_hash}}')
        			->editColumn('status', getThemeTemplate('back.system.user.listTag'))
        			->addColumn('action', getThemeTemplate('back.system.user.datatable'))

	        		->make();
	}

	public function create()
	{
		/*角色*/
		$roles = $this->roleRepo->all();
		/*性别*/
		$sexes = getSex();
		/*单位*/
		$companies = $this->companyRepo->all();
		/*通用验证*/
		$commonChecks = getCommonCheck();

		return [
			'roles' => $roles,
			'sexes' => $sexes,
			'companies' => $companies,
			'commonChecks' => $commonChecks,
		];
	}

	public function edit($id)
	{
		try {
			/*获取用户信息*/
			$id = $this->userRepo->decodeId($id);
			$user = $this->userRepo->find($id);
			/*用户选中角色*/
			$userRoles = $user->roles->keyBy('id')->keys()->toArray();
			/*所有角色*/
			$roles = $this->roleRepo->all();
			/*性别*/
			$sexes = getSex();
			/*单位*/
			$companies = $this->companyRepo->all();
			/*通用验证*/
			$commonChecks = getCommonCheck();

			return [
				'user' => $user,
				'roles' => $roles,
				'userRoles' => $userRoles,
				'sexes' => $sexes,
				'companies' => $companies,
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
				if($user = $this->userRepo->create(request()->all())) {
					/*用户绑定角色*/
					$roleIds = $this->checkParam('role', [], false);
					$companyId = $this->checkParam('company', '', false);
					event(new \App\Events\User\BindRole($user, $roleIds, $companyId));
					/*设置密码*/
					event(new \App\Events\User\SetPassword($user));
					/*设置单位信息*/
					event(new \App\Events\SetCompany($user, $companyId));




					/*清除用户菜单缓存*/
					event(new \App\Events\Menu\ClearUserMenuCache($user->id));
				} else {
					throw new Exception(trans('code/user.store.fail'), 2);
				}

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/user.store.success')
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/user.store.fail')),
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
				$id = $this->userRepo->decodeId($id);

				$data = request()->except(['password']);

				if( $user = $this->userRepo->update(request()->all(), $id) ) {
					/*用户绑定角色*/
					$roleIds = $this->checkParam('role', [], false);
					$companyId = $this->checkParam('company', '', false);
					event(new \App\Events\User\BindRole($user, $roleIds, $companyId));
					/*设置单位信息*/
					event(new \App\Events\SetCompany($user, $companyId));
					/*清除用户菜单缓存*/
					event(new \App\Events\Menu\ClearUserMenuCache($user->id));
				} else {
					throw new Exception(trans('code/user.update.fail'), 2);
				}

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/user.update.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/user.update.fail')),
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
				$id = $this->userRepo->decodeId($id);

				if( $user = $this->userRepo->delete($id) ){
					/*清除用户菜单缓存*/
					event(new \App\Events\Menu\ClearUserMenuCache($id));
				} else {
					throw new Exception(trans('code/user.destroy.fail'), 2);
				}

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/user.destroy.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/user.destroy.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}

	/**
	 * 重置密码
	 * @return [type] [description]
	 */
	public function resetPass($id)
	{
		try {
			$exception = DB::transaction(function() use ($id) {
				$id = $this->userRepo->decodeId($id);
				$user = $this->userRepo->find($id);
				/*设置密码*/
				event(new \App\Events\User\SetPassword($user));

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/user.resetpass.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/user.resetpass.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}

	/**
	 * 锁定用户
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function lock($id)
	{
		try {
			$exception = DB::transaction(function() use ($id) {
				$id = $this->userRepo->decodeId($id);
				$user = $this->userRepo->find($id);
				/*锁定用户*/
				event(new \App\Events\User\Lock($user));

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/user.lock.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/user.lock.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}

	/**
	 * 解锁用户
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function unlock($id)
	{
		try {
			$exception = DB::transaction(function() use ($id) {
				$id = $this->userRepo->decodeId($id);
				$user = $this->userRepo->find($id);
				
				/*锁定用户*/
				event(new \App\Events\User\Unlock($user));

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/user.unlock.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/user.unlock.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}
}