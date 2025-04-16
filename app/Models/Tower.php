<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_width',
        'number_of_floors',
        'number_of_elevators',
        'has_cellar',
        'water_supply',
        'electricity_supply',
        'sewerage_supply',
        'floor_number_from',
        'floor_number_to',
        'number_of_elevators_from',
        'number_of_elevators_to',
    ];

    public function ad()
    {
        return $this->morphOne(Ad::class, 'adable');
    }
}
