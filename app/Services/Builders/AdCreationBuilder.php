<?php

namespace App\Services\Builders;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

// Here we are using Builder pattern to handle complex creation of object of model
class AdCreationBuilder implements AdBuilderInterface
{
    private $ad;
    private $category;

    public function setCategory($categoryId): self
    {
        $this->category = Category::find($categoryId);
        if (!$this->category) {
            throw new \Exception("Category not found");
        }
        return $this;
    }

    public function setAdData($request): self
    {
        $adData = array_merge(
            $request->only([
                'for_rent', 'rent_duration', 'category_id', 'license_number', 'price',
                'currency_id', 'area', 'length', 'width', 'advertiser_relationship_with_property',
                'description', 'map_latitude', 'map_longitude', 'property_age', 'neighborhood_id',
                'renting_duration', 'advertiser_owner', 'is_debt', 'bound_for_sale', 'per_day_or_month'
            ]),
            ['user_id' => Auth::id(), 'adable_type' => $this->category->adable]
        );

        $this->ad = Ad::create($adData);

        return $this;
    }

    public function createAdableEntity($request): self
    {
        $adableData = $request->except([
            'for_rent', 'rent_duration', 'category_id', 'license_number', 'price',
            'currency_id', 'area', 'length', 'width', 'advertiser_relationship_with_property',
            'description', 'map_latitude', 'map_longitude', 'property_age', 'files',
            'neighborhood_id', 'renting_duration', 'face_building_id', 'advertiser_owner',
            'is_debt', 'bound_for_sale', 'number_of_apartment','number_of_living_rooms'
        ]);

        $adable = $this->category->adable::create($adableData);

        if ($adable) {
            $this->ad->adable_id = $adable->id;
            $this->ad->adable_type = $this->category->adable;
            $this->ad->save();
        }

        return $this;
    }

    public function create(): Ad
    {
        return $this->ad;
    }
}
