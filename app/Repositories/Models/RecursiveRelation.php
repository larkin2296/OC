<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class RecursiveRelation extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    public function recursive()
    {
    	return $this->morphTo();
    }
}
