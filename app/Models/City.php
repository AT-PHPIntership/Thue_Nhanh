<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class City extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * City has many posts.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'city_id');
    }

    /**
     * City has many profiles.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profiles()
    {
        return $this->hasMany('App\Models\Profile', 'city_id');
    }
}
