<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ProfileRepository;
use App\Models\Profile;
use App\Validators\ProfileValidator;

/**
 * Class ProfileRepositoryEloquent
 *
 * @package namespace App\Repositories\Eloquent;
 */
class ProfileRepositoryEloquent extends BaseRepository implements ProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Profile::class;
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

    /**
     * Hide (soft delete) the profile of user who was banned.
     *
     * @param int $id user's id
     *
     * @return boolean
     */
    public function hide(int $id)
    {
        return $this->model->destroy($id);
    }
}
