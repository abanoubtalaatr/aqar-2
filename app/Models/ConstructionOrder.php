<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getServiceTypeAttribute($value)
    {
        $typeMapping = [
            0 => __('dashboard.Residential construction'),
            1 => __('dashboard.engineering charts'),
            2 => __('dashboard.Construction supervision'),
            3 => __('dashboard.Purchasing consulting'),
            4 => __(
                'dashboard.Interior Design'
            ),
        ];

        return $typeMapping[$value] ?? 'Unknown';
    }
}
