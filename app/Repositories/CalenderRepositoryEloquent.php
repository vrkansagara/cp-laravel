<?php

namespace App\Repositories;

use App\Entities\Calender;
use App\Repositories\Interfaces\CalenderRepository;
use App\Validators\CalenderValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CalenderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CalenderRepositoryEloquent extends BaseRepository implements CalenderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Calender::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return CalenderValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
