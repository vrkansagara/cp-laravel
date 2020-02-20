<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SocialTokenManagement;

/**
 * Class SocialTokenManagementTransformer.
 *
 * @package namespace App\Transformers;
 */
class SocialTokenManagementTransformer extends TransformerAbstract
{
    /**
     * Transform the SocialTokenManagement entity.
     *
     * @param \App\Entities\SocialTokenManagement $model
     *
     * @return array
     */
    public function transform(SocialTokenManagement $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
