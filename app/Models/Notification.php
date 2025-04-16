<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    // You can define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class, 'notifiable_id');
    }
}
