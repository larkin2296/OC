<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\ReportValues;

/**
 * Class ReportValuesTransformer
 * @package namespace App\Repositories\Transformers;
 */
class ReportValuesTransformer extends TransformerAbstract
{

    /**
     * Transform the ReportValues entity
     * @param App\Repositories\Models\ReportValues $model
     *
     * @return array
     */
    public function transform(ReportValues $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
