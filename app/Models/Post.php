<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'city_id', 'address', 'lat', 'lng',
        'phone_number', 'type', 'title', 'slug', 'content', 'cost',
        'time_begin', 'time_end', 'start_date', 'end_date', 'chosen_days',
        'views', 'reviewed_by', 'reviewed_at', 'closed_at',
    ];

    /**
     * Post belongs to a category.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * Post belongs to a city.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    /**
     * Post belongs to a user.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Post belongs to a reviewer.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reviewer()
    {
        return $this->belongsTo('App\Models\User', 'reviewed_by');
    }

    /**
     * Post has many comments.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id');
    }

    /**
     * Post has many votes.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany('App\Models\Vote', 'post_id');
    }

    /**
     * Post has many reports.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany('App\Models\Report', 'post_id');
    }

    /**
     * Post has many photos.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Models\Photo', 'post_id');
    }

    /**
     * Post has many notifications.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'post_id');
    }
}
