<?php 

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Interfaces\MenuRepository;
use App\Traits\Services\Menu\MenuTrait;

class SidebarMenuComposer 
{
	use MenuTrait;

	public function __construct()
	{
		$this->menuRepo = app(MenuRepository::class);
	}

	/*输出数据 */
	public function compose(View $view)
	{
	    dd(true);
		/*左侧菜单*/
		$sidebarMenus = $this->menuList(true);
		$view->with('sidebarMenus', $sidebarMenus);

		/*控制器路由前缀*/
		$routePrefix = request()->route()->controller->routeHighLightPrefix();
		/*控制器路由*/
		$route = request()->route()->getAction('as');

		/*高亮菜单id*/
		$highLightMenuIds = $this->highLightMenu($route, $routePrefix);
		$view->with('highLightMenuIds', $highLightMenuIds);
		
		/*菜单映射*/
		$menuMaps = $this->cachedAllMenu();
		$view->with('sidebarMenuMaps', $menuMaps->keyBy('id'));
	}
}