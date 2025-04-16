<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'countries';

    public $timestamps = true;

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
