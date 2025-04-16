<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getNameAttribute()
    {

        if (app()->getLocale() == 'en') {
            return $this->name_en ?? $this->name_ar;
        } else {
            return $this->name_ar;
        }
    }

    public function getAddressAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->address_en ?? $this->address_ar;
        } else {
            return $this->address_ar;
        }
    }

    public function getSloganAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->slogan_en ?? $this->slogan_ar;
        } else {
            return $this->slogan_ar;
        }
    }

    public function getCopyRightAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->copy_right_en ?? $this->copy_right_ar;
        } else {
            return $this->copy_right_ar;
        }
    }

    //Site Rate
    public function getRateAttribute()
    {
        $r = 0;
        $rates = Rate::all();
        foreach ($rates as $rate) {
            $r += $rate->rate;
        }
        if ($rates->count() > 0) {
            $r = round($r / $rates->count());
        }

        return $r;
    }

    public function getCurrentRateAttribute()
    {
        if (auth()->guard('api')->check()) {
            $user_id = auth()->guard('api')->user()->id;
            $rate = Rate::where([
                'user_id' => $user_id,
            ])->first();

            return $rate ? $rate->rate : 0;
        } else {
            return 0;
        }
    }

    public function getHonisityAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->honisty_en;
        } else {
            return $this->honisty_ar;
        }
    }

    public function getConditionAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->ad_conditions_en;
        } else {
            return $this->ad_conditions_ar;
        }
    }
}
