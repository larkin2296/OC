<?php

namespace App;

use Laratrust\Models\LaratrustTeam;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;

class Company extends LaratrustTeam implements Transformable
{
    use TransformableTrait;
    use ModelTrait;

    protected $appends = [
        'id_hash'
    ];

    public function getIdHashAttribute()
    {
        return $this->encodeId('company', $this->id);
    }
}
