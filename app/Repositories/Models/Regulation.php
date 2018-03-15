<?php

namespace App\Repositories\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Regulation.
 *
 * @package namespace App\Repositories\Models;
 */
class Regulation extends Model implements Transformable
{
    use TransformableTrait,ModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'title',
        'severity',
        'priority',
        'finished_date',
        'data_insert',
        'data_qc',
        'medical_exam',
        'medical_exam_qc',
        'report_submit',
        'status',
        'unit',
    ];

    protected $appends = [
        'id_hash'
    ];

    public function getIdHashAttribute()
    {
        return $this->encodeId('regulation', $this->id);
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

    public function ScopeCompanyId(Builder $builder,$company_id){
        return $builder->where('company_id',$company_id);
    }

    public function ScopeSeverity(Builder $builder,$severity){
        return $builder->where('severity',$severity);
    }

}
