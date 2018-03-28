<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Purchasing.
 *
 * @package namespace App\Repositories\Models;
 */
class Purchasing extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'management';

    protected $fillable = ['oc_number','name','card_number','user_id','status','province','province_id','order_type','number'];


}
