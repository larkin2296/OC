<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\RecursiveRelation;

/**
 * Class RecursiveRelationTransformer
 * @package namespace App\Repositories\Transformers;
 */
class RecursiveRelationTransformer extends TransformerAbstract
{

    /**
     * Transform the RecursiveRelation entity
     * @param App\Repositories\Models\RecursiveRelation $model
     *
     * @return array
     */
    public function transform(RecursiveRelation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
