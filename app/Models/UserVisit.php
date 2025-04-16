<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVisit extends Model
{
    protected $fillable = ['user_id', 'visitable_id', 'visitable_type', 'last_visited_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visitable()
    {
        return $this->morphTo();
    }
}
