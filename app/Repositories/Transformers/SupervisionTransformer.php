<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\Supervision;

/**
 * Class SupervisionTransformer.
 *
 * @package namespace App\Repositories\Transformers;
 */
class SupervisionTransformer extends TransformerAbstract
{
    /**
     * Transform the Supervision entity.
     *
     * @param \App\Repositories\Models\Supervision $model
     *
     * @return array
     */
    public function transform(Supervision $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
