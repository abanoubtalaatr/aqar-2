<?php

namespace App\Http\Requests\Api\AdSell;

class AdSellRuleFactory
{
    /**
     * Get validation rules for a specific category by ID.
     */
    public static function getRulesForCategory(int $categoryId): array
    {
        $categoryRules = [
            1 => ApartmentSellRequest::class,
            2 => LandSellRequest::class,
            3 => VillaSellRequest::class,
            4 => FloorSellRequest::class,
            5 => BuildingSellRequest::class,
            6 => ShopSellRequest::class,
            7 => HouseSellRequest::class,
            8 => FarmSellRequest::class,
            9 => RestSellRequest::class,
            10 => CommercialOfficeSellRequest::class,
            11 => WarehouseSellRequest::class,
            12 => CampSellRequest::class,
            13 => RoomSellRequest::class,
            14 => StudioSellRequest::class,
            15 => ChaletSellRequest::class,
            16 => ChaletSellRequest::class,
            17 => FurnishedVillaSellRequest::class,
            18 => HallSellRequest::class,
            19 => ComplexSellRequest::class,
            20 => TowerSellRequest::class,
            21 => StationSellRequest::class,
            22 => ExhibitionSellRequest::class,
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
