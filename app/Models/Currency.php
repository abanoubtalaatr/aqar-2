<?php

namespace App\Models;

use App\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory ;
    use LanguageToggle;

    protected $guarded = [];

    public function getNameAttribute()
    {
        return $this->t('name');
    }
}
