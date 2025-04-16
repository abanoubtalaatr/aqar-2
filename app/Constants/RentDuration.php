<?php

namespace App\Constants;

final class RentDuration
{
    public const DAILY = 1;

    public const MONTHLY = 2;

    public const YEARLY = 3;

    public static function getList()
    {
        return [
            RentDuration::DAILY => __('Daily'),
            RentDuration::MONTHLY => __('Monthly'),
            RentDuration::YEARLY => __('Yearly'),
        ];
    }

    public static function getOne($index = '')
    {
        $list = self::getList();
        $list_one = array_key_exists($index, $list) ? $list[$index] : '';

        return $list_one;
    }
}
