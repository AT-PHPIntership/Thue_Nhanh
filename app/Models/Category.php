<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug',];

    /**
     * Category has many posts.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'category_id');
    }
}
