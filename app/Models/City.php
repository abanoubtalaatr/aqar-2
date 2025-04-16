<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->name_en;
        }

        return $this->name_ar;
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
