<?php

namespace App\Presenters;

use App\Transformers\SocialTokenManagementTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SocialTokenManagementPresenter.
 *
 * @package namespace App\Presenters;
 */
class SocialTokenManagementPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SocialTokenManagementTransformer();
    }
}
