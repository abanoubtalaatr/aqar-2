<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnishedApartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sewerage_supply',
        'number_of_rooms',
        'number_of_living_rooms',
        'floor_number',
        'families_or_singles',
        'sewerage_supply',
        'furnished',
        'kitchen',
        'private_roof',
        'in_villa',
        'two_entrance',
        'private_entrance',
        'elevator',
        'electricity_supply',
        'water_supply',
        'water_supply',
        'air_conditioner',
        'car_entrance',
        'number_of_bathrooms',
        'number_of_halls',
        'purpose'
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
