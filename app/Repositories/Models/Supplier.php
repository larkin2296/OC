<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Supplier.
 *
 * @package namespace App\Repositories\Models;
 */
class Supplier extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $tables = 'order';

    protected $fillable = ['name_of_card_supply','supply_status','denomination','order_type','supply_time','order_time','order_number','discount','pin_denomination_card','content','user_id','order_status'];

}
