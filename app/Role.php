<?php

namespace App;

use Laratrust\Models\LaratrustRole;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;

class Role extends LaratrustRole implements Transformable
{
    use TransformableTrait;
    use ModelTrait;

    protected $fillable = [
    	'name', 'display_name', 'description', 'organize_role_id',
    ];

    protected $appends = [
        'id_hash'
    ];

    /**
     * 获取角色的用户
     * @return [type] [description]
     */
    public function users($companyId = '')
    {
    	$users = $this->belongsToMany(
            config('laratrust.user_models.users'),
            config('laratrust.tables.role_user'),
            config('laratrust.foreign_keys.role'),
            config('laratrust.foreign_keys.user')
        )->wherePivot('user_type', config('laratrust.user_models.users'));

        if (config('laratrust.use_teams')) {
            $users->withPivot(config('laratrust.foreign_keys.team'));
        }

        if($companyId) {
            $users->where('users.company_id', $companyId);
        }

        return $users;
    }

    public function getIdHashAttribute()
    {
        return $this->encodeId('role', $this->id);
    }
}
