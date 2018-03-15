<?php

namespace App\Repositories\Models;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class DrugLibrary.
 *
 * @package namespace App\Repositories\Models;
 */
class DrugLibrary extends Model implements Transformable
{
    use TransformableTrait, ModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'type',
        'common_en_name',
        'common_zh_name',
        'common_standard_name',
        'active_ingredients',
        'drug_class',
        'manufacturer',
        'approval_number',
        'product_en_name',
        'product_zh_name',
        'specification',
        'dosage',
        'indications',
        'reg_approval_date',
        'first_sale_date',
        'replacement_date',
        'replacement_date',
        'medication_way',
        'treatment_person',
        'pinyin',
        'chemical_name',
        'molecular_formula',
        'molecular_weight',
        'trait',
        'approval_end_date',
        'country',
        'production_batch',
        'production_quantity',
        'sales',
        'sales_zone',
        'recall_num',
        'real_recall_num',
        'adverse_reactions',
        'base_drug',
        'medical_insurance_drug',
        'non_prescription_drug',
        'chinese_medicine_protection_varieties',
        'reg_date',
        'international_birth_day',
        'first_reg_date',
        'drug_testing_deadline',
        'first_reg_date_again',
        'status',
    ];

    protected $primaryKey = 'drug_id';

    protected $table = 'drug';

    protected $appends = [
        'id_hash'
    ];

    public function getIdHashAttribute()
    {
        return $this->encodeId('drug', $this->drug_id);
    }

    # region Scope
    public function scopeType(Builder $builder, $type)
    {
        return $builder->where('type', $type);
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
    #endregion


}
