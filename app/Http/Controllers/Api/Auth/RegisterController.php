<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Traits\GeneralTrait;

class RegisterController extends Controller
{
    use GeneralTrait;

    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        // Generate a 4-digit verification code
        $verificationCode = rand(1000, 9999);
        $verificationCode = 1234;
        $user->verification_code = $verificationCode;
        $user->save();

        // Send email with verification code
        // Mail::to($user->email)->send(new \App\Mail\VerifyEmail($verificationCode));
        return $this->returnSuccessMessage(__('mobile.Verification code sent to your email, Please verify your email.'));
    }
}
