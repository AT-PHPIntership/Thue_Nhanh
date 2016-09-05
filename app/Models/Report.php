<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Report extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reporter_id', 'post_id', 'description', 'processed'];

    /**
     * Report belongs to a user.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'reporter_id');
    }

    /**
     * Report belongs to a post.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }

    /**
     * Report has one (or no) validation.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function validation()
    {
        return $this->hasOne('App\Models\Validation', 'report_id');
    }
}
