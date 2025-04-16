<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;

    protected $table = 'keys';

    protected $guarded = [];

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->name_ar;
        } else {
            return $this->name_en;

        }
    }

    public function getIsRequiredAttribute($val)
    {
        if ($val === 1) {
            return __('dashboard.required');
        } else {
            return __('dashboard.not_required');
        }
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
