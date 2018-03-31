<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OilCard.
 *
 * @package namespace App\Repositories\Models;
 */
class OilCard extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'oil_card';

    protected $fillable = ['user_id','oc_number','web_account','password','oc_code','name','identity','status'];

}
