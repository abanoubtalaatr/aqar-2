<?php

namespace App\Filters;

use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

class OrderFilters
{
    protected $request;
    protected $builder;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder->whereNotNull('published_at');

        // Default ordering if none specified
        if (!$this->request->order_by && !$this->request->order_direction) {
            $this->builder->orderBy('published_at', 'desc');
        }

        // Loop through all filters in the request and apply them
        foreach ($this->request->all() as $filter => $value) {
            $method = 'filterBy' . ucfirst(Str::camel($filter));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }

        // Apply ordering after all filters have been applied
        $this->applyOrderingBy();

        return $this->builder;
    }

    protected function applyOrderingBy()
    {
        if ($this->request->has('order_by')) {
            $orderField = $this->request->order_by;
            $orderDirection = $this->request->order_direction ?? 'desc';

            switch ($orderField) {
                case 'published_at':
                    $this->builder->orderBy('published_at', $orderDirection);
                    break;

                case 'area':
                    $this->builder->orderBy('area_from', $orderDirection);
                    break;

                case 'price':
                    $this->builder->orderBy('price_from', $orderDirection);
                    break;

                case 'nearest':
                    if ($this->request->has(['user_map_latitude', 'user_map_longitude'])) {
                        $lat = $this->request->user_map_latitude;
                        $lng = $this->request->user_map_longitude;

                        $this->builder->selectRaw(
                            '*, (6371 * acos(cos(radians(?)) * cos(radians(map_latitude)) 
                            * cos(radians(map_longitude) - radians(?)) + sin(radians(?)) * sin(radians(map_latitude)))) AS distance',
                            [$lat, $lng, $lat]
                        )->orderBy('distance', $orderDirection);
                    }
                    break;
            }
        }
    }

    protected function filterByCategoryId($categoryId)
    {
        // Use a closure to group conditions properly
        $this->builder->where(function ($query) use ($categoryId) {
            if ($categoryId == 'rent') {
                $query->where('for_rent', 1);
            } elseif ($categoryId == 'sell') {
                $query->where(function ($q) {
                    $q->where('for_rent', 0)->orWhereNull('for_rent');
                });
            } elseif ($categoryId == 'per_day_or_month') {


            } elseif ($categoryId == 0 || $categoryId == -1 || $categoryId == '-1' || $categoryId == 'all') {
                // Do nothing
            } else {
                if ($categoryId != '') {
                    $query->where('category_id', intval($categoryId));
                }
            }
        })->whereNotNull('category_id');
    }

    protected function filterByForRent($forRent)
    {
        if ($forRent == 0 || $forRent == '0') {
            $this->builder->where(function ($query) {
                $query->whereNull('for_rent')->orWhere('for_rent', 0);
            });
        } elseif ($forRent == 1 || $forRent == '1') {
            $this->builder->where('for_rent', 1);
        }
    }

    protected function filterByRentingDuration($duration)
    {
        if ($this->request->filled('renting_duration')) {
            $this->builder->where('renting_duration', $duration);
        }
    }

    protected function filterByAdNumber($id)
    {
        if ($this->request->filled('id')) {
            $this->builder->where('id', $id);
        }
    }

    protected function filterById($id)
    {
        if ($this->request->filled('id')) {
            $this->builder->where('id', $id);
        }
    }

    protected function filterBySearch($term)
    {
        if ($this->request->filled('search')) {
            $this->builder->where(function ($query) use ($term) {
                $query
                    ->orWhere('map_address', 'like', "%{$term}%")
                ;
            });
        }
    }



    protected function filterByDescription($description)
    {
        if ($this->request->filled('description')) {
            $this->builder->where('description', 'like', '%' . $description . '%');
        }
    }

    protected function filterByFaceBuildingId($faceBuildingId)
    {
        if ($this->request->has('face_building_id') && $this->request->input('face_building_id') == 'all') {
            return;
        }
        if ($this->request->has('face_building_id') && $this->request->input('face_building_id') == 1) {
            return;
        }

        if ($this->request->filled('face_building_id')) {
            $this->builder->where('face_building_id', $faceBuildingId);
        }
    }

    protected function filterByPublishedAt($range)
    {
        if ($range === 'all') {
            return;
        }

        if ($this->request->filled('published_at')) {
            $daysAgo = (int) $range;
            $date = Carbon::now()->subDays($daysAgo)->format('Y-m-d');
            $this->builder->whereDate('published_at', '>=', $date);
        }
    }

    protected function filterByCreatedAt($range)
    {
        if ($range === 'all') {
            return;
        }
        if ($this->request->filled('created_at')) {
            $daysAgo = (int) $range;
            $date = Carbon::now()->subDays($daysAgo)->format('Y-m-d');
            $this->builder->whereDate('created_at', '>=', $date);
        }
    }

    protected function filterByPriceFrom()
    {
        if ($this->request->filled('price_from')) {
            $this->builder->where('price_from', '>=', $this->request->price_from);
        }
    }

    protected function filterByPriceTo()
    {
        if ($this->request->filled('price_to')) {
            $this->builder->where('price_to', '<=', $this->request->price_to);
        }
    }

    protected function filterByStreetWidthFrom()
    {
        if ($this->request->filled('street_width_from') && $this->request->street_width_from != '') {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'street_width')) {
                    $query->where('street_width', '>=', $this->request->street_width_from);
                }
            });
        }
    }

    protected function filterByStreetWidthTo()
    {
        if ($this->request->filled('street_width_to') && $this->request->street_width_to != '') {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'street_width')) {
                    $query->where('street_width', '<=', $this->request->street_width_to);
                }
            });
        }
    }

    protected function filterByAreaFrom()
    {
        if ($this->request->filled('area_from')) {
            $this->builder->where('area', '>=', $this->request->area_from);
        }
    }

    protected function filterByAreaTo()
    {
        if ($this->request->filled('area_to')) {
            $this->builder->where('area', '<=', $this->request->area_to);
        }
    }

    protected function filterByAdvertiserOwner()
    {
        if ($this->request->filled('advertiser_owner')) {
            $this->builder->where('advertiser_owner', $this->request->advertiser_owner);
        }
    }

    protected function filterByStatus()
    {
        if ($this->request->filled('status') && $this->request->input('status') == 'all') {
            return;
        }

        if ($this->request->filled('status')) {
            $this->builder->where('status', $this->request->status);
        }
    }

    protected function filterByPropertyAgeFrom()
    {
        if ($this->request->filled('property_age_from')) {
            $this->builder->where('property_age', '>=', $this->request->property_age_from);
        }
    }

    protected function filterByPropertyAgeTo()
    {
        if ($this->request->filled('property_age_to')) {
            $this->builder->where('property_age', '<=', $this->request->property_age_to);
        }
    }

    protected function filterByPurpose()
    {
        if ($this->request->has('purpose') && ($this->request->input('purpose') == 'all' || $this->request->input('purpose') == '10' || $this->request->input('purpose') == 10)) {
            return;
        }
        if ($this->request->filled('purpose')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'purpose')) {
                    $query->where('purpose', $this->request->purpose);
                }
            });
        }
    }

    protected function filterByNumberOfApartments()
    {
        if ($this->request->has('number_of_apartments') && $this->request->input('number_of_apartments') == 'all') {
            return;
        }
        if ($this->request->filled('number_of_apartments')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_apartments')) {
                    $query->where('number_of_apartments', $this->request->number_of_apartments);
                }
            });
        }
    }

    protected function filterByNumberOfRooms()
    {
        if ($this->request->has('number_of_rooms') && $this->request->input('number_of_rooms') == 'all') {
            return;
        }
        if ($this->request->filled('number_of_rooms')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_rooms')) {
                    $query->where('number_of_rooms', $this->request->number_of_rooms);
                }
            });
        }
    }

    protected function filterByNumberOfHalls()
    {
        if ($this->request->has('number_of_halls') && $this->request->input('number_of_halls') == 'all') {
            return;
        }
        if ($this->request->filled('number_of_halls')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_halls')) {
                    $query->where('number_of_halls', $this->request->number_of_halls);
                }
            });
        }
    }

    protected function filterByNumberOfBathrooms()
    {
        if ($this->request->has('number_of_bathrooms') && $this->request->input('number_of_bathrooms') == 'all') {
            return;
        }
        if ($this->request->filled('number_of_bathrooms')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_bathrooms')) {
                    $query->where('number_of_bathrooms', $this->request->number_of_bathrooms);
                }
            });
        }
    }

    protected function filterByFurnished()
    {
        if ($this->request->filled('furnished')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'furnished')) {
                    if ($this->request->furnished == 1) {
                        $query->where('furnished', 1);
                    } else {
                        $query->where('furnished', 0)->orWhere('furnished', null);
                    }
                }
            });
        }
    }

    protected function filterByCarEntrance()
    {
        if ($this->request->filled('car_entrance')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'car_entrance')) {
                    if ($this->request->car_entrance == 1) {
                        $query->where('car_entrance', 1);
                    } else {
                        $query->where('car_entrance', 0)->orWhere('car_entrance', null);
                    }
                }
            });
        }
    }

    protected function filterByHasAttached()
    {
        if ($this->request->filled('has_attached')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'has_attached')) {
                    if ($this->request->has_attached == 1) {
                        $query->where('has_attached', 1);
                    } else {
                        $query->where('has_attached', 0)->orWhere('has_attached', null);
                    }
                }
            });
        }
    }

    protected function filterByElevator()
    {
        if ($this->request->filled('elevator')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'elevator')) {
                    if ($this->request->elevator == 1) {
                        $query->where('elevator', 1);
                    } else {
                        $query->where('elevator', 0)->orWhere('elevator', null);
                    }
                }
            });
        }
    }

    protected function filterByHasElevator()
    {
        if ($this->request->filled('has_elevator')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'has_elevator')) {
                    if ($this->request->has_elevator == 1) {
                        $query->where('has_elevator', 1);
                    } else {
                        $query->where('has_elevator', 0)->orWhere('has_elevator', null);
                    }
                }
            });
        }
    }

    protected function filterByIsCellar()
    {
        if ($this->request->filled('is_cellar')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'is_cellar')) {
                    if ($this->request->is_cellar == 1) {
                        $query->where('is_cellar', 1);
                    } else {
                        $query->where('is_cellar', 0)->orWhere('is_cellar', null);
                    }
                }
            });
        }
    }

    protected function filterByHasCellar()
    {
        if ($this->request->filled('has_cellar')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'has_cellar')) {
                    if ($this->request->has_cellar == 1) {
                        $query->where('has_cellar', 1);
                    } else {
                        $query->where('has_cellar', 0)->orWhere('has_cellar', null);
                    }
                }
            });
        }
    }

    protected function filterByPool()
    {
        if ($this->request->filled('pool')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'pool')) {
                    if ($this->request->pool == 1) {
                        $query->where('pool', 1);
                    } else {
                        $query->where('pool', 0)->orWhere('pool', null);
                    }
                }
            });
        }
    }

    protected function filterBySwimmingPool()
    {
        if ($this->request->filled('swimming_pool')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'swimming_pool')) {
                    if ($this->request->swimming_pool == 1) {
                        $query->where('swimming_pool', 1);
                    } else {
                        $query->where('swimming_pool', 0)->orWhere('swimming_pool', null);
                    }
                }
            });
        }
    }

    protected function filterByKitchen()
    {
        if ($this->request->filled('kitchen')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'kitchen')) {
                    if ($this->request->kitchen == 1) {
                        $query->where('kitchen', 1);
                    } else {
                        $query->where('kitchen', 0)->orWhere('kitchen', null);
                    }
                }
            });
        }
    }

    protected function filterByMaidRoom()
    {
        if ($this->request->filled('maid_room')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'maid_room')) {
                    if ($this->request->maid_room == 1) {
                        $query->where('maid_room', 1);
                    } else {
                        $query->where('maid_room', 0)->orWhere('maid_room', null);
                    }
                }
            });
        }
    }

    protected function filterByDriverRoom()
    {
        if ($this->request->filled('driver_room')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'driver_room')) {
                    if ($this->request->driver_room == 1) {
                        $query->where('driver_room', 1);
                    } else {
                        $query->where('driver_room', 0)->orWhere('driver_room', null);
                    }
                }
            });
        }
    }

    protected function filterByNumberOfFloorsFrom()
    {
        if ($this->request->filled('number_of_floors_from')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_floors')) {
                    $query->where('number_of_floors', '>=', $this->request->number_of_floors_from);
                }
            });
        }
    }

    protected function filterByNumberOfFloorsTo()
    {
        if ($this->request->filled('number_of_floors_to')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_floors')) {
                    $query->where('number_of_floors', '<=', $this->request->number_of_floors_to);
                }
            });
        }
    }

    protected function filterByNumberOfElevatorsFrom()
    {
        if ($this->request->filled('number_of_elevators_from')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_elevators')) {
                    $query->where('number_of_elevators', '>=', $this->request->number_of_elevators_from);
                }
            });
        }
    }

    protected function filterByNumberOfElevatorsTo()
    {
        if ($this->request->filled('number_of_elevators_to')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_elevators')) {
                    $query->where('number_of_elevators', '<=', $this->request->number_of_elevators_to);
                }
            });
        }
    }

    protected function filterByNumberOfRoomsFrom()
    {
        if ($this->request->filled('number_of_rooms_from')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_rooms')) {
                    $query->where('number_of_rooms', '>=', $this->request->number_of_rooms_from);
                }
            });
        }
    }

    protected function filterByNumberOfRoomsTo()
    {
        if ($this->request->filled('number_of_rooms_to')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_rooms')) { // Fixed typo: ' ' to 'number_of_rooms'
                    $query->where('number_of_rooms', '<=', $this->request->number_of_rooms_to); // Fixed typo: '=<'
                }
            });
        }
    }

    protected function filterByNumberOfShopsFrom()
    {
        if ($this->request->filled('number_of_shops_from')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_shops')) {
                    $query->where('number_of_shops', '>=', $this->request->number_of_shops_from);
                }
            });
        }
    }

    protected function filterByNumberOfShopsTo()
    {
        if ($this->request->filled('number_of_shops_to')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_shops')) {
                    $query->where('number_of_shops', '<=', $this->request->number_of_shops_to);
                }
            });
        }
    }

    protected function filterByNumberOfUnitsFrom()
    {
        if ($this->request->filled('number_of_units_from')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_units')) {
                    $query->where('number_of_units', '>=', $this->request->number_of_units_from);
                }
            });
        }
    }

    protected function filterByNumberOfUnitsTo()
    {
        if ($this->request->filled('number_of_units_to')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'number_of_units')) {
                    $query->where('number_of_units', '<=', $this->request->number_of_units_to);
                }
            });
        }
    }

    protected function filterByHasOffices()
    {
        if ($this->request->filled('has_offices')) {
            $this->builder->whereHas('adable', function ($query) {
                if (Schema::hasColumn($query->getModel()->getTable(), 'has_offices')) {
                    if ($this->request->input('has_offices')) {
                        $query->where('has_offices', 1);
                    } else {
                        $query->where('has_offices', 0)->orWhere('has_offices', null);
                    }
                }
            });
        }
    }

    protected function filterByPhone()
    {
        if ($this->request->filled('phone')) {
            $this->builder->whereHas('user', function ($query) {
                $query->where('phone', 'like', '%' . $this->request->phone . '%');
            });
        }
    }

    // protected function filterByCityId()
    // {
    //     if ($this->request->filled('city_id')) {
    //         $city = City::find($this->request->city_id);
    //         if ($city) {
    //             $this->builder->whereBetween('map_latitude', [$city->latitude_min, $city->latitude_max])
    //                 ->whereBetween('map_longitude', [$city->longitude_min, $city->longitude_max]);
    //         }
    //     }
    // }

    protected function filterByCityMapLatitude()
    {
        // Check if all coordinates (user and city) are present
        if ($this->request->filled('city_map_latitude') &&
            $this->request->filled('city_map_longitude') &&
            $this->request->filled('user_map_latitude') &&
            $this->request->filled('user_map_longitude')) {

        }
        // Only execute city coordinate filtering if user coordinates aren't present
        elseif ($this->request->filled(['city_map_latitude', 'city_map_longitude'])) {
            $lat = $this->request->city_map_latitude;
            $lng = $this->request->city_map_longitude;
            $radius = $this->request->input('radius', 40); // Default radius of 40 km

            // Earth's radius in kilometers
            $earthRadius = 6371;

            // Apply Haversine formula using raw SQL with city coordinates
            $this->builder->whereRaw(
                "
            $earthRadius * acos(
                cos(radians(?)) * cos(radians(map_latitude)) * cos(radians(map_longitude) - radians(?)) +
                sin(radians(?)) * sin(radians(map_latitude))
            ) <= ?",
                [$lat, $lng, $lat, $radius]
            );
        }
    }
}
