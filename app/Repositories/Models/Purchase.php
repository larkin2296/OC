<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Purchase.
 *
 * @package namespace App\Repositories\Models;
 */
class Purchase extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'purchase';

    protected $fillable = ['purchase_number','denomination','number','commodity','price','total_price','status'];

}
