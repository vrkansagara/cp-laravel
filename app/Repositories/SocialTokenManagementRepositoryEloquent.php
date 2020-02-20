<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\SocialTokenManagementRepository;
use App\Entities\SocialTokenManagement;
use App\Validators\SocialTokenManagementValidator;

/**
 * Class SocialTokenManagementRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SocialTokenManagementRepositoryEloquent extends BaseRepository implements SocialTokenManagementRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SocialTokenManagement::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SocialTokenManagementValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
