<?php

namespace App\Http\Requests\Api\Order\Sell;

class CategorySellRuleFactory
{
    /**
     * Get validation rules for a specific category by ID.
     */
    public static function getRulesForCategory(int $categoryId): array
    {
        $categoryRules = [
            1 => ApartmentRequest::class,
            2 => LandRequest::class,
            3 => VillaRequest::class,
            4 => FloorRequest::class,
            5 => buildingRequest::class,
            6 => ShopRequest::class,
            8 => FarmRequest::class,
            9 => RestRequest::class,
            18 => HallRequest::class,
            19 => ComplexRequest::class,
            20 => TowerRequest::class,
            21 => StationRequest::class,
            22 => ExhibitionRequest::class,
        ];

        // If a specific category request class exists, use it
        if (array_key_exists($categoryId, $categoryRules)) {
            $categoryRequest = new $categoryRules[$categoryId]();
            return $categoryRequest->rules();
        }

        // Default to empty array if no specific rules found
        return [];
    }
}
