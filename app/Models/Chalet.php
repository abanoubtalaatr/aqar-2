<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chalet extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_width',
        'number_of_rooms',
        'number_of_living_rooms',
        'number_of_bathrooms',
        'kitchen',
        'pool',
        'car_entrance',
        'families_or_singles',
        'football_field',
        'volleyball_field',
        'amusement_park_games',
        'family_area',
        'verse',
        'water_supply',
        'electricity_supply',
        'sewerage_supply',
    ];

    public function ad()
    {
        return $this->morphOne(Ad::class, 'adable');
    }

    public function order()
    {
        return $this->morphOne(Order::class, 'adable');
    }

    public function getFamiliesOrSinglesAttribute($val)
    {
        if ($val == 0) {
            return __('dashboard.for_family');
        } elseif ($val == 1) {
            return __('dashboard.for_singles');
        } elseif ($val == 2) {
            return __('dashboard.for_family').' '.__('dashboard.and').' '.__('dashboard.for_singles');
        }
    }
}
