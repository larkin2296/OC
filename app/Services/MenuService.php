<?php 

namespace App\Services;

use     App\Traits\ResultTrait;
use App\Traits\ExceptionTrait;
use App\Traits\ServiceTrait;
use App\Traits\Services\Menu\MenuTrait;
use Exception;
use DB;

class MenuService extends Service
{
	use ServiceTrait, ResultTrait, ExceptionTrait, MenuTrait;

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		try {
			$menus = $this->menuList();

			$menuMaps = $this->cachedAllMenu()->keyBy('id');

			return [
				'menus' => $menus,
				'menuMaps' => $menuMaps,
			];
		} catch (Exception $e) {
			abort(404);	
		}
	}

	public function create(){
		try {
			$id = request('id', 0);
			$id = $this->menuRepo->decodeId($id);

			/*菜单位置*/
			$positions = getMenuPosition();

			$parentMenu = $id ? $this->menuRepo->find($id) : [];
			$parentMenu = $this->parentMenu($parentMenu);
		} catch (Exception $e) {
		}

		return [
			'parentMenu' => $parentMenu,
			'positions' => $positions,
		];
	}

	public function store(){
		try {
			$exception = DB::transaction(function(){
				$data = request()->all();

				if( $menu = $this->menuRepo->create($data) ){

					/*执行绑定父级菜单*/
					$parentMenuId = request('parent_id');
					$parentMenuId = $this->menuRepo->decodeId($parentMenuId);
					event(new \App\Events\Menu\BindParentMenu($menu, $parentMenuId));

					/*清除菜单缓存*/
					event(new \App\Events\FlushCache());
				} else {
					throw new Exception(trans('code/menu.store.fail'), 2);
				}

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/menu.store.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/menu.store.fail')),
			]);
		}
		return array_merge($this->results, $exception);
	}

	public function edit($id){
		try {
			/*修改的菜单*/
			$id = $this->menuRepo->decodeId($id);
			$menu = $this->menuRepo->find($id);

			/*父级菜单*/
			$parentMenu = $this->parentMenu($menu->parentMenu->first());

			/*菜单位置*/
			$positions = getMenuPosition();

			return [
				'menu' => $menu,
				'parentMenu' => $parentMenu,
				'positions' => $positions,
			];
		} catch (Exception $e) {
			abort(404);
		}

	}

	private function parentMenu($parentMenu)
	{
		$defaultParentMenu = [
			'id_hash' => 0,
			'id' => 0,
			'name' => '顶级菜单'
		];

		return $parentMenu ? $parentMenu->toArray() : $defaultParentMenu;
	}

	public function update($id){
		try {
			$exception = DB::transaction(function() use ($id){
				$id = $this->menuRepo->decodeId($id);

				$data = request()->all();

				if( $menu = $this->menuRepo->update($data, $id) ){

					/*执行绑定父级菜单*/
					$parentMenuId = request('parent_id');
					$parentMenuId = $this->menuRepo->decodeId($parentMenuId);
					event(new \App\Events\Menu\BindParentMenu($menu, $parentMenuId));

					/*清除菜单缓存*/
					event(new \App\Events\FlushCache());
				} else {
					throw new Exception(trans('code/menu.update.fail'), 2);
				}

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/menu.update.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/menu.update.fail')),
			]);
		}
		return array_merge($this->results, $exception);
	}

	/**
	 * 删除菜单
	 * @param  [type] $id [菜单id]
	 * @return [type]     [description]
	 */
	public function destroy($id){
		try {
			$exception = DB::transaction(function() use ($id){
				/*获取菜单*/
				$id = $this->menuRepo->decodeId($id);
				$menu = $this->menuRepo->find($id);
				if($this->menuRepo->delete($id) ){

					/*执行取消菜单关系*/
					event(new \App\Events\Menu\DetachMenuRelation($menu));

					/*清除菜单缓存*/
					event(new \App\Events\FlushCache());
				} else {
					throw new Exception(trans('code/menu.destroy.fail'), 2);
				}

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/menu.destroy.success'),
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/menu.destroy.fail')),
			]);
		}
		return array_merge($this->results, $exception);
	}

	/**
	 * 菜单排序
	 * @return [type] [description]
	 */
	public function sort(){
		try {
			$exception = DB::transaction(function() {
				/*解析json数据*/
				$menuIds = json_decode(request('data'), 'true');

				/*排序菜单*/
				$parentMenu = Null;
				$this->sortMenu($menuIds, $parentMenu);

				/*清除菜单缓存*/
				event(new \App\Events\FlushCache());

				return array_merge($this->results, [
					'result' => true,
					'message' => trans('code/menu.sort.success')
				]);
			});
		} catch (Exception $e) {
			$exception = array_merge($this->results, [
				'result' => false,
				'message' => $this->handler($e, trans('code/menu.sort.fail')),
			]);
		}

		return array_merge($this->results, $exception);
	}

	private function sortMenu($menuIds, $parentMenu)
	{
		if($menuIds) {
			foreach($menuIds  as $key => $val){
				/*获取菜单*/
				$menuId = $val['id'];
				$menuId = $this->menuRepo->decodeId($menuId);
				$menu = $this->menuRepo->find($menuId);

				event(new \App\Events\Menu\SortCurrentMenu($menu, $key, $parentMenu));

				/*存在子菜单需要排序*/
				if(isset($val['children']) && $val['children']) {
					$this->sortMenu($val['children'], $menu);
				}
			}
		}
	}
}