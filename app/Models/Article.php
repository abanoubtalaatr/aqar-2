<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getTitleAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->title_en;
        }

        return $this->title_ar;
    }

    public function getDescriptionAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->description_en;
        }

        return $this->description_ar;
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
