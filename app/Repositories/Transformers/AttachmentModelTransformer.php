<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Repositories\Models\AttachmentModel;

/**
 * Class AttachmentModelTransformer.
 *
 * @package namespace App\Repositories\Transformers;
 */
class AttachmentModelTransformer extends TransformerAbstract
{
    /**
     * Transform the AttachmentModel entity.
     *
     * @param \App\Repositories\Models\AttachmentModel $model
     *
     * @return array
     */
    public function transform(AttachmentModel $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
