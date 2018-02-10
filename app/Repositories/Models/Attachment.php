<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attachment.
 *
 * @package namespace App\Repositories\Models;
 */
class Attachment extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use ModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'origin_name', 'file_size', 'path', 'file_ext', 'ext_info', 'status', 'user_id', 'user_name',
    ];

    public function getIdHashAttribute()
    {
        return $this->encodeId('attachment', $this->id);
    }
}
