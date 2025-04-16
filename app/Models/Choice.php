<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $table = 'choices';

    protected $guarded = [];

    public function getValueAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->value_ar;
        } else {
            return $this->value_en;
        }
    }

    public function key()
    {
        return $this->belongsTo(Key::class);
    }
}
