<?php

namespace App\Repositories\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Category.
 *
 * @package namespace App\Repositories\Models;
 */
class Category extends Model implements Transformable
{
    use TransformableTrait,ModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'pid',
        'company_id',
        'module',
        'sort',
        'status',
    ];

    protected $table = 'category';

    protected $appends = [
        'id_hash'
    ];

    public function getIdHashAttribute()
    {
        return $this->encodeId('category', $this->id);
    }

    public function ScopeStatus(Builder $builder, $status, $not_in = false)
    {
        if (is_array($status)) {
            if ($not_in) {
                return $builder->whereNotIn('status', $status);
            }

            return $builder->whereIn('status', $status);
        } else {
            if ($not_in) {
                return $builder->where('status', '<>', $status);
            }

            return $builder->where('status', $status);
        }

    }

}
