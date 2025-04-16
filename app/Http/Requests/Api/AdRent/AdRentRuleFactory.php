<?php

namespace App\Http\Requests\Api\AdRent;

class AdRentRuleFactory
{
    /**
     * Get validation rules for a specific category by ID.
     */
    public static function getRulesForCategory(int $categoryId): array
    {
        $categoryRules = [
            1 => ApartmentRentRequest::class,
            2 => LandRentRequest::class,
            3 => VillaRentRequest::class,
            4 => FloorRentRequest::class,
            5 => buildingRentRequest::class,
            6 => ShopRentRequest::class,
            8 => FarmRentRequest::class,
            9 => RestRentRequest::class,
            10 => CommercialOfficeRentRequest::class,
            13 => RoomRentRequest::class,
            15 => ChaletRentRequest::class,
            16 => FurnishedApartmentRentRequest::class,
            19 => ComplexRentRequest::class,
            18 => HallRentRequest::class,
            20 => TowerRentRequest::class,
            21 => StationRentRequest::class,
            22 => ExhibitionRentRequest::class,
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
