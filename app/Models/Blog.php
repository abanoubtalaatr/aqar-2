<?php

namespace App\Models;

use App\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    use LanguageToggle;

    public $guarded = [];

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function getTypeAttribute($value)
    {
        $typeMapping = [
            0 => __('dashboard.construction and contracting'),
            1 => __('dashboard.rating neighborhood'),
            2 => __('dashboard.decoration'),
            3 => __('dashboard.real estate news'),
            4 => __(
                'dashboard.garas reports'
            ),
        ];

        return $typeMapping[$value] ?? 'Unknown';
    }
    // public function getTranslatedTypeAttribute($value)
    // {
    //     $this->t($this->getTypeAttribute($value));

    //     return $typeMapping[$value] ?? 'Unknown';
    // }

}
