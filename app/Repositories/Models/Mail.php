<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Mail extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'mail';

    protected $fillable = ['service_type','mail_account','mail_password','company_id','server','port','ssl_crypt','status'];

}
