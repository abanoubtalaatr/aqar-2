<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreHouse extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ad()
    {
        return $this->morphOne(Ad::class, 'adable');
    }

    public function order()
    {
        return $this->morphOne(Order::class, 'adable');
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
