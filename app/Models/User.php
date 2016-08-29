<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Transformable
{
    use TransformableTrait;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'validation_code', 'activated', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'validation_code'
    ];

    /**
     * User belongs to many roles.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_roles');
    }

    /**
     * User has one profile.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile', 'user_id');
    }

    /**
     * User has many notifications.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'user_id');
    }

    /**
     * User has many comments.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'user_id');
    }

    /**
     * User has many votes.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany('App\Models\Vote', 'user_id');
    }

    /**
     * User has many reports.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany('App\Models\Report', 'user_id');
    }

    /**
     * User has many reports.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reportsReviewed()
    {
        return $this->hasMany('App\Models\Violation', 'reviewer_id');
    }

    /**
     * User has many own posts.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'user_id');
    }

    /**
     * User has many posts which were reviewed by themself.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postsReviewed()
    {
        return $this->hasMany('App\Models\Post', 'reviewed_by');
    }
}
