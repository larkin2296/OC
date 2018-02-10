<?php

namespace App\Subscribes;

use App\Repositories\Interfaces\PermissionRepository;

class RoleEventSubscribe
{   
    /**
     * 绑定角色权限
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onBindPermission($event)
    {
        /*获取角色和权限id*/
        $role = $event->role;
        $permissionIds = $event->permissionIds;

        /*重置可用权限id*/
        $permissions = app(PermissionRepository::class)->findWhereIn('id', $permissionIds);
        $bindPermissionIds = $permissions->keyBy('id')->keys()->toArray();

        $role->syncPermissions($bindPermissionIds);
    }

    public function subscribe($events)
    {
        /*绑定角色*/
        $events->listen(
            'App\Events\Role\BindPermission',
            'App\Subscribes\RoleEventSubscribe@onBindPermission'
        );
    }
}
