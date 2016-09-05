<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ViolationRepository;
use App\Models\Violation;
use App\Validators\ViolationValidator;

/**
 * Class ViolationRepositoryEloquent
 *
 * @package namespace App\Repositories\Eloquent;
 */
class ViolationRepositoryEloquent extends BaseRepository implements ViolationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Violation::class;
    }



    /**
     * Boot up the repository, pushing criteria
     *
     * @return void
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
