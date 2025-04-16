<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Mobile\AdMapResourse;
use App\Models\Ad;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    use GeneralTrait;

    public function loginSearch(Request $request)
    {
        $map_latitude = $request->map_latitude ?? null;
        $map_longitude = $request->map_longitude ?? null;
        $ads = Ad::active()->where('cat_id', $request->cat_id)
            ->when($request->for_rent != null && $request->for_rent != 2, function ($query) use ($request) {
                return $query->where('for_rent', $request->for_rent);
            })
            ->when($request['price_from'] != null, function ($query) use ($request) {
                return $query->where('price', '>=', $request['price_from']);
            })->when($request['price_to'] != null, function ($query) use ($request) {
                return $query->where('price', '<=', $request['price_to']);
            })->when($request->city, function ($query) use ($request) {
                return $query->whereHas('city', function ($query) use ($request) {
                    return $query->where('name_ar', 'LIKE', '%'.$request->city.'%')
                        ->orWhere('name_en', 'LIKE', '%'.$request->city.'%');
                });
            })
            ->when($request->map_latitude, function ($query) use ($map_latitude, $map_longitude) {
                return $query->wherebetween('map_latitude', [$map_latitude - 10, $map_latitude + 10])
                    ->wherebetween('map_longitude', [$map_longitude - 10, $map_longitude + 10]);
            })
            ->orderBy('created_at', 'desc')->get();

        return ! $ads->isEmpty() ?
            $this->returnData('ads', AdMapResourse::collection($ads))
            : $this->returnSuccessMassage(__('site.there is no ads match your search'), false);
    }

    public function search(Request $request)
    {

        $ads = Ad::active()->where('cat_id', $request->cat_id)
            ->when($request->for_rent != null && $request->for_rent != 2, function ($query) use ($request) {
                return $query->where('for_rent', $request->for_rent);
            })
            ->when($request->price_from != null, function ($query) use ($request) {
                return $query->where('price', '>=', $request->price_from);
            })
            ->when($request->price_to != null, function ($query) use ($request) {
                return $query->where('price', '<=', $request->price_to);
            })
            ->when($request->is_family != null, function ($query) use ($request) {
                return $query->where('is_family', $request->is_family);
            })
            ->when($request->city != null, function ($query) use ($request) {
                return $query->whereHas('city', function ($query) use ($request) {
                    return $query->where('name_ar', 'LIKE', '%'.$request->city.'%')
                        ->orWhere('name_en', 'LIKE', '%'.$request->city.'%');
                });
            })->get();
        // filter for Static Keys
        $filteredCollection = collect(); // Create an empty collection
        if ($request->static_keys && $request->static_keys != null) {
            foreach ($ads as $ad) {
                $matchesAllStaticKeys = true;
                foreach ($request->static_keys as $static_key) {
                    if ($ad->adable->getRawOriginal($static_key['key']) != $static_key['value']) {
                        $matchesAllStaticKeys = false;
                        break; // No need to continue checking if one key doesn't match
                    }
                }
                if ($matchesAllStaticKeys) {
                    $filteredCollection->push($ad); // Add the ad to the filtered collection
                }
            }
            $ads = $filteredCollection;
        }
        $data = AdMapResourse::collection($ads);

        return $this->returnData('data', $data);
    }

    public function filterWithPagination(Request $request)
    {

        $ads = Ad::active()
            ->when($request->category_id != null, function ($query) use ($request) {
                return $query->where('cat_id', $request->category_id);
            })
            ->when($request->for_rent != null, function ($query) use ($request) {
                return $query->where('for_rent', $request->for_rent);
            })
            ->orderBy('created_at', 'desc')->paginate(6);
        $ads_data = AdMapResourse::collection($ads)->response()->getData(true);

        return $this->returnData('ads', $ads_data);
    }

    public function filterWithoutPagination(Request $request)
    {
        $ads = Ad::active()
            ->when($request->has('category_id'), function ($query) use ($request) {
                return $query->where('cat_id', $request->category_id);
            })
            ->when($request->has('for_rent'), function ($query) use ($request) {
                return $query->where('for_rent', $request->for_rent);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        $ads_data = AdMapResourse::collection($ads);

        return $this->returnData('ads', $ads_data);
    }
}
