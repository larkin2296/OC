<?php

namespace App;

use Laratrust\Models\LaratrustPermission;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;

class Permission extends LaratrustPermission implements Transformable
{
    use TransformableTrait;
    use ModelTrait;

    protected $fillable = [
    	'name', 'display_name', 'description'
    ];

    protected $appends = [
        'id_hash'
    ];

    public function getIdHashAttribute()
    {
        return $this->encodeId('permission', $this->id);
    }
}
