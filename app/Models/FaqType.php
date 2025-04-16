<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqType extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'is_active'];

    protected $appends = ['title'];

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->name_en;
        }

        return $this->name_ar;
    }

    public function getTitleAttribute()
    {
        return $this->name_en;
    }

}
