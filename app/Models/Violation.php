<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Violation extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'violations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reporter_id', 'reviewer_id', 'description'];

    /**
     * Violation belongs to report.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function report()
    {
        return $this->belongsTo('App\Models\Report', 'report_id');
    }

    /**
     * Violation belongs to reviewer (user).
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reviewer()
    {
        return $this->belongsTo('App\Models\User', 'reviewer_id');
    }
}
