<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class DataTrace.
 *
 * @package namespace App\Repositories\Models;
 */
class DataTrace extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'company_id', 'report_id', 'report_identify', 'report_tab_id', 'field', 'old_value', 'new_value', 'action_status', 'action_description', 'user_id', 'user_name', 'user_role',
    ];

}
