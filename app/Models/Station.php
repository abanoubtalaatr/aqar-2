<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_width',
        'length',
        'width',
        'is_equipped',
        'is_rented',
        'water_supply',
        'electricity_supply',
        'sewerage_supply',
    ];

    public function ad()
    {
        return $this->morphOne(Ad::class, 'adable');
    }
}
