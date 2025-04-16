<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnishedVilla extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_width',
        'number_of_rooms',
        'number_of_living_rooms',
        'number_of_bathrooms',
        'kitchen',
        'amusement_park_games',
        'air_conditioner',
        'driver_room',
        'maid_room',
        'swimming_pool',
        'car_entrance',
        'furnished',
        'elevator',
        'basement',
        'living_room_stairs',
        'verse',
        'water_supply',
        'electricity_supply',
        'sewerage_supply',
        'playground',
        'families_or_singles',
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

    public function getInterfaceAttribute($val)
    {
        if ($val == 0) {
            return __('dashboard.north');
        } elseif ($val == 1) {
            return __('dashboard.east');
        } elseif ($val == 2) {
            return __('dashboard.west');
        } elseif ($val == 3) {
            return __('dashboard.south');
        } elseif ($val == 4) {
            return __('dashboard.south').' '.__('dashboard.east');
        } elseif ($val == 5) {
            return __('dashboard.north').' '.__('dashboard.east');
        } elseif ($val == 6) {
            return __('dashboard.south').' '.__('dashboard.west');
        } elseif ($val == 7) {
            return __('dashboard.south').' '.__('dashboard.west');
        } elseif ($val == 8) {
            return __('dashboard.3_street');
        } elseif ($val == 9) {
            return __('dashboard.4_street');
        } else {
            return __('dashboard.unknown');
        }
    }
}
