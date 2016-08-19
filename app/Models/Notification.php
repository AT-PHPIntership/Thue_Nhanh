<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'type_id', 'notification', 'dismissed'];

    /**
     * Notification belongs to a notification type.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function notificationType()
    {
        return $this->belongsTo('App\Models\NotificationType', 'type_id');
    }

    /**
     * Notification belongs to a user.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
