<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FavouriteRequest;
use App\Http\Resources\Api\AdResource;
use App\Models\Ad;
use App\Models\Favourite;
use App\Traits\GeneralTrait;
use Tymon\JWTAuth\Facades\JWTAuth;

class FavouriteController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $favourites = Ad::whereIn('id', Favourite::where('user_id', auth('api')->user()->id)->pluck('ad_id'))->paginate(6);
        $favourites_data = AdResource::collection($favourites)->response()->getData(true);

        return $this->returnData('ads', $favourites_data);
    }

    public function store(FavouriteRequest $request)
    {
        $user = JWTAuth::user();
        if (! $user->alreadyFavourite($request->ad_id)) {
            $user->favourites()->attach($request->ad_id);

            return $this->returnSuccessMassage('stored succssfully');
        } else {
            return $this->returnSuccessMassage('already in your favourites');
        }
    }

    public function destroy($ad_id)
    {
        JWTAuth::user()->favourites()->detach($ad_id);

        return $this->returnSuccessMassage('deleted succssfully');
    }
}
