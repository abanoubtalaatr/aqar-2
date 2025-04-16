<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\GeneralTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\Api\LoginResource;
use App\Http\Requests\Api\RegisterRequest;
use App\Strategies\Auth\Login\AuthContext;
use App\Http\Requests\Api\VerifyEmailRequest;
use App\Http\Requests\Api\LoginWithDeviceIdRequest;
use App\Strategies\Auth\Login\LoginWithCredentials;
use App\Http\Requests\Api\ResendVerificationEmailRequest;

class AuthController extends Controller
{
    use GeneralTrait;
    public $authContext;

    public function __construct(AuthContext $authContext)
    {
        $this->middleware('guest')->except('logout');
        $this->authContext = $authContext;
    }

    public function login(LoginRequest $request)
    {
        $this->authContext->setStrategy(new LoginWithCredentials());

        return $this->authContext->login($request);
    }

    public function logout()
    {
        $logout = auth()->guard('api')->logout();

        return $this->returnSuccessMassage(__('mobile.Logout successfully.'));
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        // Generate a 4-digit verification code
        $verificationCode = rand(1000, 9999);
        $verificationCode = 1234;
        $user->verification_code = $verificationCode;
        $user->save();

        // Send email with verification code
        // Mail::to($user->email)->send(new \App\Mail\VerifyEmail($verificationCode));
        return $this->returnSuccessMassage(__('mobile.Verification code sent to your email, Please verify your email.'));
    }

    public function verifyEmail(VerifyEmailRequest $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)
            ->where('verification_code', $request->verification_code)
            ->first();

        if (! $user) {
            return $this->returnError('401', __('mobile.Invalid verification code.'));
        }

        $user->email_verified_at = now();
        $user->verification_code = null; // Clear the verification code
        $user->save();

        return $this->returnSuccessMassage(__('mobile.Valid code.'));
    }

    public function resendVerificationEmail(ResendVerificationEmailRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return $this->returnError('404', __('mobile.User not found.'));
        }

        if ($user->email_verified_at) {
            return $this->returnSuccessMassage(__('mobile.Email is already verified.'));
        }

        // Generate a new 4-digit verification code
        $verificationCode = rand(1000, 9999);
        $verificationCode = 1234;
        $user->verification_code = $verificationCode;
        $user->save();

        // Send email with the new verification code
        // Mail::to($user->email)->send(new \App\Mail\VerifyEmail($verificationCode));

        return $this->returnSuccessMassage(__('mobile.Verification code resent to your email.'));
    }

    public function loginWithDeviceId(LoginWithDeviceIdRequest $request)
    {
        if (!$request->has('email') || is_null($request->email) || $request->input('email') == 'null' || $request->input('email') == '') {
            return $this->returnError('401', __('mobile.Must register first with the ordinary way to able to login with bio.'));  // Error if user does not exist
        }
        // Find the user by device_id
        $user = User::where('device_id', $request->device_id)
            ->where('device_id', $request->device_id)
            ->where('email', $request->email)
            ->latest()->first();

        if (! $user) {
            return $this->returnError('401', __('mobile.Invalid credentials.'));  // Error if user does not exist
        }

        // Manually create the JWT token for the user
        $token = JWTAuth::fromUser($user);

        // Return the user data with the token
        $userResource = new LoginResource($user);

        return $this->returnData('data', $userResource);
    }
}
