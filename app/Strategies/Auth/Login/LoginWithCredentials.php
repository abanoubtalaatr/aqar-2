<?php

namespace App\Strategies\Auth\Login;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\Api\LoginResource;
use App\Services\General\RequestUserAgentService;

class LoginWithCredentials implements AuthStrategyInterface
{
    use GeneralTrait;

    public function login(Request $request)
    {
        $loginRequest = LoginRequest::createFromBase($request);

        // Fetch user, including soft-deleted
        $user = User::withTrashed()->where('email', $loginRequest->email)->first();

        if (!$user) {
            return $this->returnError('401', __('mobile.User not found.'));
        }

        if ($user && $user->verification_code) {
            return $this->returnError('401', __('mobile.Must verify your account first or you maybe make forgot password and not complete the process.'), false);
        }

        if (!$user->is_active) {
            return $this->returnError('401', __('mobile.Your account now is suspended.'));
        }

        // Manual password verification
        $credentials = $loginRequest->only('email', 'password');


        if (!Hash::check($credentials['password'], $user->password)) {
            return $this->returnError('401', __('mobile.Invalid credentials.'));
        }

        // Generate token manually
        $token = JWTAuth::fromUser($user);

        // Restore user and update last login
        $user->update(['last_login' => now(), 'deleted_at' => null]);

        $userResource = new LoginResource($user);

        if (RequestUserAgentService::getUserAgent($request) == 'mobile') {
            $userResource = new LoginResource($user);
        }

        return $this->returnData('data', $userResource, __("mobile.Login successfully."), ['token' => $token]);
    }
}
