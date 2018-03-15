<?php

namespace App\Subscribes;

use App\Repositories\Interfaces\RoleRepository;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\UserRepository;

class UserEventSubscribe
{   
    /**
     * 绑定用户角色
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onBindRole($event)
    {
        $user = $event->user;

        $roleIds = $event->roleIds;

        $companyId = $event->companyId;

        $roles = app(RoleRepository::class)->findWhereIn('id', $roleIds);

        $company = app(CompanyRepository::class)->find($companyId);

        $bindRoleIds = $roles->keyBy('id')->keys()->toArray();

        $user->syncRoles($bindRoleIds, $company);
    }

    /**
     * 设置用户密码
     * @return [type] [description]
     */
    public function onSetPassword($event)
    {
        $user = $event->user;
        /*默认密码123456*/
        $password = request('password', '123456');

        $user->password = bcrypt($password);
        $user->save();
    }

    /**
     * 锁定用户
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onLock($event)
    {
        $user = $event->user;

        $user->status = getCommonCheckValue(false);
        if(!$user->save()) {
            throw new Exception(trans('code/user.lock.fail'), 2);
        }
    }

    /**
     * 锁定用户
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onUnlock($event)
    {
        $user = $event->user;

        $user->status = getCommonCheckValue(true);
        if(!$user->save()) {
            throw new Exception(trans('code/user.unlock.fail'), 2);
        }
    }

    /**
     * 通过企业id， 批量修改用户的企业名称
     * @param  [type] $event [description]
     * @return [type]        [description]
     */
    public function onSetCompanyName($event)
    {
        $company = $event->company;

        $userRepo = app(UserRepository::class);

        $data = [
            'company_name' => $company->name,
        ];

        $where = [
            'company_id' => $company->id,
        ];

        $userRepo->updateWhere($data, $where);
    }

    public function subscribe($events)
    {
        /*绑定角色*/
        $events->listen(
            'App\Events\User\BindRole',
            'App\Subscribes\UserEventSubscribe@onBindRole'
        );

        /*设置密码*/
        $events->listen(
            'App\Events\User\SetPassword',
            'App\Subscribes\UserEventSubscribe@onSetPassword'
        );

        /*锁定用户*/
        $events->listen(
            'App\Events\User\Lock',
            'App\Subscribes\UserEventSubscribe@onLock'
        );

        /*解锁用户*/
        $events->listen(
            'App\Events\User\Unlock',
            'App\Subscribes\UserEventSubscribe@onUnlock'
        );

        /*修改用户的企业名称*/
        $events->listen(
            'App\Events\User\SetCompanyName',
            'App\Subscribes\UserEventSubscribe@onSetCompanyName'
        );
    }
}
