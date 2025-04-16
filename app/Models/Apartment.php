<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_width',
        'number_of_rooms',
        'number_of_living_rooms',
        'number_of_bathrooms',
        'floor_number',
        'furnished',
        'kitchen',
        'sewerage_supply',
        'private_roof',
        'electricity_supply',
        'water_supply',
        'air_conditioner',
        'car_entrance',
        'elevator',
        'private_entrance',
        'purpose',
        'number_of_halls',
    ];

    public function ad()
    {
        return $this->morphOne(Ad::class, 'adable');
    }

    public function order()
    {
        return $this->morphOne(Order::class, 'orderable');
    }

    public function getFamiliesOrSinglesAttribute($val)
    {
        if ($val === '0') {
            return __('dashboard.for_family');
        } elseif ($val === '1') {
            return __('dashboard.for_singles');
        } elseif ($val === '2') {
            return __('dashboard.for_family').' '.__('dashboard.and').' '.__('dashboard.for_singles');
        }
    }
}
