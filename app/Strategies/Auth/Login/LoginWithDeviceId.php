<?php

namespace App\Strategies\Auth\Login;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\Api\LoginResource;
use App\Http\Requests\Api\LoginWithDeviceIdRequest;

class LoginWithDeviceId implements AuthStrategyInterface
{
    use GeneralTrait;
    public function login(Request $request)
    {
        $loginRequest = LoginWithDeviceIdRequest::createFromBase($request);

        $user = User::withTrashed()->where('device_id', $loginRequest->device_id)
            ->where('email', $loginRequest->email)
            ->first();

        if (!$user) {
            return $this->returnError('401', __('mobile.Invalid credentials.'));
        }


        $token = JWTAuth::fromUser($user);
        $userResource = new LoginResource($user);
        $user->update(['last_login' => now(),'deleted_at' => null]);
        return $this->returnData('data', $userResource, __("mobile.Login successfully."));
    }
}
