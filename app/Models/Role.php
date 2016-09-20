<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Role extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description',];

    /**
     * Role belongs to many user.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_roles');
    }

    public static function findByRole($roleName)
    {
        return self::where('roles.name', ucwords($roleName))
                     ->join('user_roles', 'user_roles.role_id', '=', 'roles.id')
                     ->join('users', 'users.id', '=', 'user_roles.user_id')
                     ->join('profiles', 'profiles.user_id', '=', 'users.id')
                     ->join('cities', 'profiles.city_id', '=', 'cities.id')
                     ->select('users.id', 'users.name', 'cities.name as city', 'users.created_at', 'users.email', 'user_roles.role_id')
                     ->where('users.activated', \Config::get('common.ACTIVATED'))
                     ->orderBy('users.name')
                     ->get();
    }
}
