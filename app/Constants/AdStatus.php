<?php

namespace App\Constants;

final class AdStatus
{
    public const PENDING = 'pending';

    public const ACTIVE = 'active';

    public const EXPIRED = 'expired';

    public const REPORTED = 'reported';

    public const DRAFT = 'draft';

    public static function getList()
    {
        return [
            AdStatus::PENDING => __('Pending'),
            AdStatus::ACTIVE => __('Active'),
            AdStatus::EXPIRED => __('Expired'),
            AdStatus::REPORTED => __('Reported'),
            AdStatus::DRAFT => __('Draft'),
        ];
    }

    public static function getOne($index = '')
    {
        $list = self::getList();
        $list_one = array_key_exists($index, $list) ? $list[$index] : '';

        return $list_one;
    }
}
