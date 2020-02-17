<?php

namespace App\Presenters;

use App\Transformers\CalenderTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CalenderPresenter.
 *
 * @package namespace App\Presenters;
 */
class CalenderPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CalenderTransformer();
    }
}
