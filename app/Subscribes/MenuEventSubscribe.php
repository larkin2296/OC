<?php

namespace App\Subscribes;

use App\Repositories\Interfaces\MenuRepository;
use Cache;

class MenuEventSubscribe
{   
    /**
     * 绑定角色权限
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onBindParentMenu($event)
    {
        /*获取角色和权限id*/
        $menu = $event->menu;
        $parentMenuId = $event->parentMenuId;

        /*重置可用权限id*/
        if($parentMenuId) {
            $parentMenu = app(MenuRepository::class)->find($parentMenuId);
            
            $this->bindParentMenu($menu, $parentMenu->id);
        }
    }

    /**
     * 删除菜单关系
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onDetachMenuRelation($event)
    {
        $menu = $event->menu;

        $menu->parentMenu()->detach();
        $menu->sonMenus()->detach();
    }

    /**
     * 排序当前菜单
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onSortCurrentMenu($event)
    {
        $menu = $event->menu;
        $sort = $event->sort;
        $parentMenu = $event->parentMenu;

        /*保存菜单排序*/
        $menu->sort = $sort;
        $menu->save();

        /*绑定父级菜单*/
        if($parentMenu) {
            $bindData[$parentMenu->id] = [
                'sort' => $sort,
            ];
        } else {
            $bindData = [];
        }

        $this->bindParentMenu($menu, $bindData);
    }

    /**
     * 绑定父级菜单
     * @param  [type] $menu         [description]
     * @param  [type] $parentMenuId [description]
     * @return [type]               [description]
     */
    private function bindParentMenu($menu, $bindData)
    {
        $menu->parentMenu()->sync($bindData);   
    }

    /**
     * 清除用户菜单缓存
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onClearUserMenuCache($event)
    {
        $userId = $event->userId;

        $key = getCacheUserMenu($userId);

        Cache::forget($key);
    }

    /**
     * 清除所有菜单缓存
     */
    public function onClearAllMenuCache($event)
    {
        $key = getCacheAllMenu();

        Cache::forget($key);
    }

    public function subscribe($events)
    {
        /*绑定角色*/
        $events->listen(
            'App\Events\Menu\BindParentMenu',
            'App\Subscribes\MenuEventSubscribe@onBindParentMenu'
        );

        /*删除菜单关系*/
        $events->listen(
            'App\Events\Menu\DetachMenuRelation',
            'App\Subscribes\MenuEventSubscribe@onDetachMenuRelation'
        );

        /*排序当前菜单*/
        $events->listen(
            'App\Events\Menu\SortCurrentMenu',
            'App\Subscribes\MenuEventSubscribe@onSortCurrentMenu'
        );

        /*清楚用户菜单缓存*/
        $events->listen(
            'App\Events\Menu\ClearUserMenuCache',
            'App\Subscribes\MenuEventSubscribe@onClearUserMenuCache'
        );

        /*清除所有菜单缓存*/
        $events->listen(
            'App\Events\Menu\ClearAllMenuCache',
            'App\Subscribes\MenuEventSubscribe@onClearAllMenuCache'
        );
    }
}
