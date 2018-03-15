<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Questioning extends Model implements Transformable
{
    use TransformableTrait;

    public $timestamps = false;

    protected $table = 'send_information';

    protected $fillable = ['question_id','end_date','status','content','email','email_theme','phone:_number','express','ems_express','sending'];

}
