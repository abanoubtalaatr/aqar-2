<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    use GeneralTrait;

    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    /**
     * Obtain the user information from Social Logged in.
     *
     * @return Response
     */
    public function handleProviderCallback($social)
    {
        if (! Request()->input('code')) {
            return $this->returnError('', 'Login failed: '.Request()->input('error').' - '.Request()->input('error_reason'));
        }

        $userSocial = Socialite::driver($social)->stateless()->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        if ($user) {
            Auth::login($user);

            return $this->returnSuccessMassage('', __('api.you already have account ,, loged in successfully'));
        } else {
            $user = User::create([
                'name' => $userSocial->getName(),
                'email' => $userSocial->getEmail(),

            ]);
            Auth::login($user);

            return $this->returnSuccessMassage('', __('api.loged in successfully'));

        }

    }
}
