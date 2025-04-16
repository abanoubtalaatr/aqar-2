<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\LoginResource;
use App\Http\Resources\Api\SimpleAdResource;

class UserDetailsController extends Controller
{
    use GeneralTrait;

    public function show(Request $request, User $user)
    {
        $ads = Ad::where('user_id', $user->id)->where('category_id', '!=', null)->get();
        $rating = $user->ratings;

        $user = LoginResource::make($user);

        $data['user'] = $user;
        $data['ads'] = SimpleAdResource::collection($ads);
        $data['ratings'] = $rating;

        return $this->returnData('data', $data);
    }
}
