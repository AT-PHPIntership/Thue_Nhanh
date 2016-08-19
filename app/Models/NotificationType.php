<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    protected $table = 'notification_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['message'];

    /**
     * Notification type has many notifications.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notification()
    {
        return $this->hasMany('App\Models\Notification', 'type_id');
    }
}
