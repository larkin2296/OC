<?php

namespace App\Repositories\Models;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Dictionaries extends Model implements Transformable
{
    use TransformableTrait;
    use LaratrustUserTrait;
    use Notifiable;
//    use TransformableTrait;
//关闭自动更新时间戳
    public $timestamps = false;

    protected $fillable = [
        'serial','chinese','english','forpage','structure','dict_id','created_at','updated_at'
    ];
    /*定义字典模型关系*/
    public function data()
    {
//        dd(1);
        return $this->hasMany('App\Repositories\Models\Subdictionaries','dict_id','id');
    }

}
