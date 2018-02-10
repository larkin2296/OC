<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\Regulation;

/**
 * Class RegulationTransformer.
 *
 * @package namespace App\Repositories\Transformers;
 */
class RegulationTransformer extends TransformerAbstract
{
    /**
     * Transform the Regulation entity.
     *
     * @param \App\Repositories\Models\Regulation $model
     *
     * @return array
     */
    public function transform(Regulation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
