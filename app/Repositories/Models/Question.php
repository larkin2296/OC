<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Question extends Model implements Transformable
{
    protected $table = 'question';

    use TransformableTrait;

    public $timestamps = false;

    protected $fillable = ['question_num','report_num','operation_name','operation_id','status','operation_date','content','end_date','sending'];

}
