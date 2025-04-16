<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_width',
        'water_supply',
        'electricity_supply',
        'sewerage_supply',
    ];

    public function ad()
    {
        return $this->morphOne(Ad::class, 'adable');
    }
}
