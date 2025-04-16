<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'categories';

    public $timestamps = true;

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->name_en;
        }

        return $this->name_ar;
    }

    public function keys()
    {
        return $this->hasMany(Key::class);
    }
}
