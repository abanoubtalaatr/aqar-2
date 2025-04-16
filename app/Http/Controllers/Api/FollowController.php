<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\LoginResource;

class FollowController extends Controller
{
    use GeneralTrait;

    public function follow(User $user)
    {
        $currentUser = auth()->user();
        if (!$currentUser->followings()->where('followed_id', $user->id)->exists()) {
            $currentUser->followings()->attach($user->id);
        }
        return $this->returnSuccessMessage(__("User followed successfully"));
    }

    public function unfollow(User $user)
    {
        $currentUser = auth()->user();
        $currentUser->followings()->detach($user->id);

        return $this->returnSuccessMessage(__("User unfollowed successfully"));
    }

    // عرض قائمة المستخدمين المتابعين
    public function getFollowings()
    {
        // Paginate followings with 10 items per page
        $followings = auth()->user()->followings()->paginate(10);

        // Return paginated followings
        return $this->returnData('data', LoginResource::collection($followings)->response()->getData());
    }

    public function getFollowers()
    {
        // Paginate followers with 10 items per page
        $followers = auth()->user()->followers()->paginate(10);

        // Return paginated followers
        return $this->returnData('data', LoginResource::collection($followers)->response()->getData());
    }

}
