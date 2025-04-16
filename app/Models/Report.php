<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $guarded = [];

    protected $table = 'reports';

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
