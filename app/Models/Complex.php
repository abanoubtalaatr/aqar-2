<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complex extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_width',
        'purpose',
        'number_of_shops',
        'number_of_units',
        'is_offices',
        'has_cellar',
        'water_supply',
        'electricity_supply',
        'sewerage_supply',
        'number_of_shops_from',
'number_of_shops_to',
'number_of_units_from',
'number_of_units_to',
'has_offices',
    ];

    public function ad()
    {
        return $this->morphOne(Ad::class, 'adable');
    }
}
