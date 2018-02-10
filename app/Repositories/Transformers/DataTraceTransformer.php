<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\DataTrace;

/**
 * Class DataTraceTransformer.
 *
 * @package namespace App\Repositories\Transformers;
 */
class DataTraceTransformer extends TransformerAbstract
{
    /**
     * Transform the DataTrace entity.
     *
     * @param \App\Repositories\Models\DataTrace $model
     *
     * @return array
     */
    public function transform(DataTrace $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
