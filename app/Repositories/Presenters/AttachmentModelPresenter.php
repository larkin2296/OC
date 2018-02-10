<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\AttachmentModelTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AttachmentModelPresenter.
 *
 * @package namespace App\Repositories\Presenters;
 */
class AttachmentModelPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AttachmentModelTransformer();
    }
}
