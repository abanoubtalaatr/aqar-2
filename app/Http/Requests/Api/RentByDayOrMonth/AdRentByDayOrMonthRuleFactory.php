<?php

namespace App\Http\Requests\Api\RentByDayOrMonth;

class AdRentByDayOrMonthRuleFactory
{
    /**
     * Get validation rules for a specific category by ID.
     */
    public static function getRulesForCategory(int $categoryId): array
    {
        $categoryRules = [
            8 => FarmRequest::class,
            9 => RestRequest::class,
            13 => RoomRequest::class,
            15 => ChaletRequest::class,
            16 => FurnishedApartmentRequest::class,
            18 => HallRequest::class,
        ];

        // If a specific category request class exists, get rules that belongs to this category id
        if (array_key_exists($categoryId, $categoryRules)) {
            $categoryRequest = new $categoryRules[$categoryId]();
            return $categoryRequest->rules();
        }

        // Default to empty array if no specific rules found
        return [];
    }
}
