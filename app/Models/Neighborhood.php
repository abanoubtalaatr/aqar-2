<?php

namespace App\Models;

use App\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;
    use LanguageToggle;

    public $guarded = [];

    public function getNameAttribute()
    {
        return $this->t('name');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }
}
