<?php

namespace App\Services\General;

class FormatPrice
{
    public static function format($price)
    {
        if ($price >= 1000 && $price < 1000000) {
            // Format to thousands
            $formatted = round($price / 1000, 1); // Keeps one decimal if needed
            return app()->getLocale() === 'ar' ? $formatted . ' ألف' : $formatted . ' k';
        } elseif ($price >= 1000000) {
            // Format to millions
            $formatted = round($price / 1000000, 1);
            return  app()->getLocale() === 'ar' ? $formatted . ' مليون' : $formatted . ' M';
        }
        return $price;
    }
}
