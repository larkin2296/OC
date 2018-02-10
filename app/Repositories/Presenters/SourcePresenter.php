<?php

namespace App\Repositories\Presenters;

use App\Repositories\Transformers\SourceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SourcePresenter.
 *
 * @package namespace App\Repositories\Presenters;
 */
class SourcePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SourceTransformer();
    }
}
