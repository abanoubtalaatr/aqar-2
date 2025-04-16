<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_width',
        'number_of_rooms',
        'number_of_living_rooms',
        'number_of_bathrooms',
        'floor_number',
        'furnished',
        'water_supply',
        'air_conditioner',
        'car_entrance',
        'sewerage_supply',
        'electricity_supply',
        'elevator',
        'two_entrance',
        'private_entrance',
        'purpose',
        'number_of_halls',
        'number_of_floors'
    ];

    public function ad()
    {
        return $this->morphOne(Ad::class, 'adable');
    }

    public function order()
    {
        return $this->morphOne(Order::class, 'adable');
    }
}
