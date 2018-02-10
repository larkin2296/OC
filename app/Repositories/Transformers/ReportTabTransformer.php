<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\ReportTab;

/**
 * Class ReportTabTransformer.
 *
 * @package namespace App\Repositories\Transformers;
 */
class ReportTabTransformer extends TransformerAbstract
{
    /**
     * Transform the ReportTab entity.
     *
     * @param \App\Repositories\Models\ReportTab $model
     *
     * @return array
     */
    public function transform(ReportTab $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
