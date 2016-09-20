<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\UserRepository;
use App\Models\User;
use App\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 *
 * @package namespace App\Repositories\Eloquent;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
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
     * Select user accounts with given condition.
     *
     * @param string $field data field
     * @param mixed  $value the value
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function having($field, $value)
    {
        return $this->model
                    ->where($field, $value)
                    ->with('profile')
                    ->with('roles')
                    ->join('profiles', 'users.id', '=', 'profiles.user_id')
                    ->join('cities', 'cities.id', '=', 'profiles.city_id')
                    ->select('users.id', 'users.name', 'users.created_at', 'users.email', 'cities.name as city')
                    ->get();
    }
}
