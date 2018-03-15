<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\SupervisionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SupervisionPresenter.
 *
 * @package namespace App\Repositories\Presenters;
 */
class SupervisionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SupervisionTransformer();
    }
}
