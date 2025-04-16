<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_width',
        'furnished',
        'sewerage_supply',
        'electricity_supply',
        'water_supply',
        'room_of_numbers',
    ];

    public function ad()
    {
        return $this->morphOne(Ad::class, 'adable');
    }

    public function order()
    {
        return $this->morphOne(Order::class, 'adable');
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

    public function getAdvertiserCharacteristicAttribute($val)
    {
        if ($val === 0) {
            return __('dashboard.owner');
        } elseif ($val == 1) {
            return __('dashboard.office');
        } elseif ($val == 2) {
            return __('dashboard.mediator');
        }
    }
}
