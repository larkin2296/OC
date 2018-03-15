<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\RegulationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RegulationPresenter.
 *
 * @package namespace App\Repositories\Presenters;
 */
class RegulationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RegulationTransformer();
    }
}
