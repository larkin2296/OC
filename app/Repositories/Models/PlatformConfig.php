<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PlatformConfig.
 *
 * @package namespace App\Repositories\Models;
 */
class PlatformConfig extends Model implements Transformable
{

    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'platform_config';
    protected $fillable = ['platform_code','platform_name','status','regular','created_at','updated_at'];

}
