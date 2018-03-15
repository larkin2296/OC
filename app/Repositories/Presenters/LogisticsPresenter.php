<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\LogisticsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LogisticsPresenter.
 *
 * @package namespace App\Repositories\Presenters;
 */
class LogisticsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LogisticsTransformer();
    }
}
