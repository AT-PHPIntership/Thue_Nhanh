<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ReportRepository;
use App\Models\Report;
use App\Validators\ReportValidator;

/**
 * Class ReportRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class ReportRepositoryEloquent extends BaseRepository implements ReportRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Report::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
