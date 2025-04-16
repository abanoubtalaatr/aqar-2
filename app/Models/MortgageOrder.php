<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MortgageOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getHavePersonalFinanceAttribute($value)
    {
        $typeMapping = [
            1 => __('dashboard.have_finance'),
            0 => __('dashboard.have_no_finance'),
        ];

        return $typeMapping[$value] ?? 'Unknown';
    }

    public function getEligibleForSupportAttribute($value)
    {
        $typeMapping = [
            1 => __('dashboard.eligible_for_support'),
            0 => __('dashboard.not_eligible_for_support'),
        ];

        return $typeMapping[$value] ?? 'Unknown';
    }

    public function getArabicDateAttribute($value)
    {
        $typeMapping = [
            1 => __('dashboard.supported'),
            0 => __('dashboard.not_supported'),
        ];

        return $typeMapping[$value] ?? 'Unknown';
    }
}
