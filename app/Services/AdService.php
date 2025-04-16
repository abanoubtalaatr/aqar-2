<?php

// app/Services/AdService.php

namespace App\Services;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdService
{
    public function updateAd($request, $id)
    {
        $ad = Ad::find($id);
        if (!$ad) {
            return null; // Ad not found
        }

        $category = Category::find($request->category_id);
        $ad_data = $this->prepareAdData($request, $category);


        // Handle the adable logic
        $adable = $this->handleAdable($ad, $request, $category);

        if (!$adable) {
            return null; // Adable creation/update failed
        }

        // Set the adable ID and update the ad
        $ad_data['adable_id'] = $adable->id;
        $ad->update($ad_data);

        return $ad;
    }

    private function prepareAdData($request, $category)
    {
        return array_merge(
            $request->only([
                'for_rent', 'rent_duration', 'category_id', 'license_number', 'price',
                'currency_id', 'area', 'length', 'width', 'advertiser_relationship_with_property',
                'description', 'map_latitude', 'map_longitude', 'property_age', 'neighborhood_id',
                'renting_duration', 'advertiser_owner', 'is_debt', 'bound_for_sale','city_id','face_building_id',
            ]),
            [
                'user_id' => Auth::id(),
                'adable_type' => $category->adable
            ]
        );
    }

    private function handleAdable($ad, $request, $category)
    {
        if ($ad->adable && $ad->adable_type != $category->adable) {
            // Delete the old adable object and create a new one
            $ad->adable->delete();
            return $this->createNewAdable($request, $category);
        }

        return $ad->adable
            ? $this->updateAdable($ad->adable, $request)
            : $this->createNewAdable($request, $category);
    }

    private function updateAdable($adable, $request)
    {
        $adable->update($this->getAdableData($request));
        return $adable;
    }

    private function createNewAdable($request, $category)
    {
        return $category->adable::create($this->getAdableData($request));
    }

    private function getAdableData($request)
    {
        if ($request->for_rent == 0) {
            //remove renting duration because taking default value
            return $request->except([
                'for_rent', 'category_id', 'license_number', 'price',
                'currency_id', 'area', 'length', 'width', 'advertiser_relationship_with_property',
                'description', 'map_latitude', 'map_longitude', 'property_age', 'files',
                'neighborhood_id', 'renting_duration', 'face_building_id', 'advertiser_owner',
                'is_debt', 'bound_for_sale', 'number_of_apartment',
            ]);
        }
        return $request->except([
            'for_rent', 'rent_duration', 'category_id', 'license_number', 'price',
            'currency_id', 'area', 'length', 'width', 'advertiser_relationship_with_property',
            'description', 'map_latitude', 'map_longitude', 'property_age', 'files',
            'neighborhood_id', 'renting_duration', 'face_building_id', 'advertiser_owner',
            'is_debt', 'bound_for_sale', 'number_of_apartment',
        ]);
    }
}
