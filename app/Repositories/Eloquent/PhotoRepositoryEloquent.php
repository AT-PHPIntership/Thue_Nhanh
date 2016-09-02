<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\PhotoRepository;
use App\Models\Photo;
use App\Validators\PhotoValidator;

/**
 * Class PhotoRepositoryEloquent
 *
 * @package namespace App\Repositories\Eloquent;
 */
class PhotoRepositoryEloquent extends BaseRepository implements PhotoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Photo::class;
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
