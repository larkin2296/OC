<?php

namespace App\Repositories\Models;

use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Subdictionaries extends Model implements Transformable
{
    protected $table = 'subdictionaries';
    use TransformableTrait;
    use LaratrustUserTrait;
    use Notifiable;
//    use TransformableTrait;
//关闭自动更新时间戳
    public $timestamps = false;

    protected $fillable = ['sub_chinese','sub_english','dict_id','e_formate','e_name','created_at','updated_at'];

}
