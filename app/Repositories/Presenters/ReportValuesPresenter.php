<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\ReportValuesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ReportValuesPresenter
 *
 * @package namespace App\Repositories\Presenters;
 */
class ReportValuesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ReportValuesTransformer();
    }
}
