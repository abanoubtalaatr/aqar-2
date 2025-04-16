<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\SendEmailRequest;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    use GeneralTrait;

    public function sendEmail(SendEmailRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return $this->returnError('404', __('mobile.User not found.'));
        }

        $token = Str::random(30);

        $verificationCode = rand(1000, 9999);
        $verificationCode = 1234;

        $user->update([
            'token' => $token,
            'verification_code' => $verificationCode,
        ]);

        // Mail::to($user->email)->send(new \App\Mail\VerifyEmail($verificationCode));

        $data['token'] = $token;

        return $this->returnArrayData($data);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = User::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (! $user) {
            return $this->returnError('400', __('mobile.Invalid code.'));
        }

        $user->password = $request->password;
        $user->token = null; // Clear the token
        $user->verification_code = null;
        $user->save();

        return $this->returnSuccessMassage(__('mobile.Password has been reset successfully.'));
    }

    public function resendResetToken(SendEmailRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return $this->returnError('404', __('mobile.User not found.'));
        }

        $token = Str::random(30);

        $verificationCode = rand(1000, 9999);
        $verificationCode = 1234;

        $user->update([
            'token' => $token,
            'verification_code' => $verificationCode
        ]);

        // Mail::to($user->email)->send(new \App\Mail\VerifyEmail($verificationCode));

        $data['token'] = $token;

        return $this->returnArrayData($data);
    }
}
