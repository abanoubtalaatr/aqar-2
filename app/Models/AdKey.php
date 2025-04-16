<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdKey extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function key()
    {
        return $this->belongsTo(Key::class);
    }
}
