<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\NotificationTypeRepository;
use App\Models\NotificationType;
use App\Validators\NotificationTypeValidator;

/**
 * Class NotificationTypeRepositoryEloquent
 *
 * @package namespace App\Repositories\Eloquent;
 */
class NotificationTypeRepositoryEloquent extends BaseRepository implements NotificationTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NotificationType::class;
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
