<?php

namespace App\Constants;

final class OrderStatus
{
    public const PENDING = 'pending';

    public const ACTIVE = 'active';

    public const EXPIRED = 'expired';

    public const REPORTED = 'reported';

    public const DRAFT = 'draft';

    public static function getList()
    {
        return [
            OrderStatus::PENDING => __('Pending'),
            OrderStatus::ACTIVE => __('Active'),
            OrderStatus::EXPIRED => __('Expired'),
            OrderStatus::REPORTED => __('Reported'),
            OrderStatus::DRAFT => __('Draft'),
        ];
    }

    public static function getOne($index = '')
    {
        $list = self::getList();
        $list_one = array_key_exists($index, $list) ? $list[$index] : '';

        return $list_one;
    }
}
