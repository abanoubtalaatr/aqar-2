<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Follower;
use App\Traits\GeneralTrait;
use Tymon\JWTAuth\Facades\JWTAuth;

class FollowerController extends Controller
{
    use GeneralTrait;

    public function follow(FollowRequest $request)
    {
        $follower = new Follower();
        if ($follower->alreadyFollow($request->follower_id)) {
            return $this->returnError('422', __('site.already_follow'));
        } else {
            Follower::create([
                'user_id' => JWTAuth::user()->id,
                'follower_id' => $request->follower_id,
            ]);

            return $this->returnSuccessMassage(__('site.followed_successsfully'));
        }
    }
    // public function follow(FollowRequest $request)
    // {
    //     if(Follower::alreadyFollow($request->follower_id,JWTAuth::user()->id)){
    //         return $this->returnError('422',__('site.already_follow'));
    //     }else{
    //         Follower::create([
    //             'user_id' => JWTAuth::user()->id,
    //             'follower_id' => $request->follower_id
    //         ]);
    //         return $this->returnSuccessMassage(__('site.followed_successsfully'));
    //     }
    // }

    public function unfollow(FollowRequest $request)
    {

        $user_id = auth()->guard('api')->user()->id;

        $follower = Follower::where([
            'user_id' => $user_id,
            'follower_id' => $request->follower_id,
        ]);
        if ($follower) {
            $follower->delete();
        }

        return $this->returnSuccessMassage(__('site.unfollowed_successsfully'));
    }
}
