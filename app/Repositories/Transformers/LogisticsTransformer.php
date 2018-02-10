<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\Logistics;

/**
 * Class LogisticsTransformer.
 *
 * @package namespace App\Repositories\Transformers;
 */
class LogisticsTransformer extends TransformerAbstract
{
    /**
     * Transform the Logistics entity.
     *
     * @param \App\Repositories\Models\Logistics $model
     *
     * @return array
     */
    public function transform(Logistics $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
