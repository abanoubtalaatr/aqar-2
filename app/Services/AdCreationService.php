<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdCreationService
{
    public function createAdWithAdable($request)
    {
        // Find the related category
        $category = Category::find($request->category_id);
        if (!$category) {
            return null; // Handle case when category is not found
        }

        // Prepare ad data
        $ad_data = $this->prepareAdData($request, $category);

        // Create the ad
        $ad = Ad::create($ad_data);

        // Create the related adable entity
        $adable = $this->createNewAdable($request, $category);

        if ($adable) {
            // Associate adable with the ad
            $ad->adable_id = $adable->id;
            $ad->adable_type = $category->adable;
            $ad->save();
        }

        return $ad;
    }

    public function updateAdWithAdable($adId, $request)
    {
        $ad = Ad::find($adId);
        if (!$ad) {
            return null;
        }

        $category = Category::find($request->category_id);
        if (!$category) {
            return null;
        }

        $ad_data = $this->prepareAdData($request, $category);
        $ad->update($ad_data);

        $adable = $ad->adable;
        if ($adable && $adable->id) {
            $adable->update($this->getAdableData($request));
        } else {
            $newAdable = $this->createNewAdable($request, $category);
            $ad->adable_id = $newAdable->id;
            $ad->adable_type = $category->adable;
            $ad->save();
        }

        return $ad;
    }


    public function prepareAdData($request, $category)
    {
        return array_merge(
            $request->only([
                'for_rent',
                'rent_duration',
                'category_id',
                'license_number',
                'price',
                'currency_id',
                'area',
                'length',
                'width',
                'advertiser_relationship_with_property',
                'description',
                'map_latitude',
                'map_longitude',
                'property_age',
                'neighborhood_id',
                'renting_duration',
                'advertiser_owner',
                'is_debt',
                'bound_for_sale',
                'per_day_or_month',
                'city_id'
            ]),
            [
                'user_id' => Auth::id(),
                'adable_type' => $category->adable
            ]
        );
    }

    private function createNewAdable($request, $category)
    {
        // Create a new adable entity for the specified category
        return $category->adable::create($this->getAdableData($request));
    }

    private function getAdableData($request)
    {
        // Exclude fields specific to the ad model and return data for the adable
        return $request->except([
            'for_rent',
            'rent_duration',
            'category_id',
            'license_number',
            'price',
            'currency_id',
            'area',
            'length',
            'width',
            'advertiser_relationship_with_property',
            'description',
            'map_latitude',
            'map_longitude',
            'property_age',
            'files',
            'neighborhood_id',
            'renting_duration',
            'face_building_id',
            'advertiser_owner',
            'is_debt',
            'bound_for_sale',
            'number_of_apartment',
            'city_id'
        ]);
    }
}
