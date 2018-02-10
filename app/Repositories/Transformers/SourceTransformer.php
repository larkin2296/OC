<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\Source;

/**
 * Class SourceTransformer.
 *
 * @package namespace App\Repositories\Transformers;
 */
class SourceTransformer extends TransformerAbstract
{
    /**
     * Transform the Source entity.
     *
     * @param \App\Repositories\Models\Source $model
     *
     * @return array
     */
    public function transform(Source $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
