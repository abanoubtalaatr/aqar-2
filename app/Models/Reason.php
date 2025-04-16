<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;

    public function getTitleAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->title_en;
        }

        return $this->title_ar;
    }

}
