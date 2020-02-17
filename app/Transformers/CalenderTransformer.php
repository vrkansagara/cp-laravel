<?php

namespace App\Transformers;

use App\Entities\Calender;
use League\Fractal\TransformerAbstract;

/**
 * Class CalenderTransformer.
 *
 * @package namespace App\Transformers;
 */
class CalenderTransformer extends TransformerAbstract
{
    /**
     * Transform the Calender entity.
     *
     * @param \App\Entities\Calender $model
     *
     * @return array
     */
    public function transform(Calender $model)
    {
        return [
            'id' => (int)$model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
