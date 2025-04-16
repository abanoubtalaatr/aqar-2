<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    // user login with phone
    // public function LoginWithPhone(UserPhoneLoginRequest $request)
    // {
    //     $user = User::where('phone',$request->phone)->first();
    //     try {
    //         if(isset($user))
    //         {
    //             $user->update(['active' => 0,'code' => rand(1000, 9999),'google_device_token' => $request->google_device_token]);
    //             $token = JWTAuth::fromUser($user);
    //             $user = new ProfileResource($user);
    //             return response()->json(['data' => $user,'status' => 200,'message' => 'success']);
    //         }
    //         else
    //         {
    //             return response()->json(['status' => 400 ,'message' => __('lang.invalid_credentials'), 'data' => []]);
    //         }
    //     } catch (JWTException $e) {
    //         return response()->json(['status' => $e->getStatusCode(), 'message' =>  __('lang.invalid_credentials'), 'data' => []]);
    //     }
    // }

    // public function sendResetPassword(UserResetPasswordRequest $request)
    // {

    //     try {
    //         PasswordReset::where('email', $request->email)->delete();

    //         $user = User::query()->where('email', $request->email)->first();
    //         $code = Str::random(5);
    //         $data = [
    //             'name' => $user->name,
    //             'code' => $code,
    //         ];
    //         PasswordReset::query()->create([
    //             'email' => $user->email,
    //             'code' => $code,
    //             // 'created_at' =>Carbon::now(),
    //         ]);
    //         Mail::send('mails.reset-password', $data, function ($mail) use ($user) {
    //             $mail->subject('Your password reset request');
    //             $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    //             $mail->to($user->email, $user->name);
    //         });
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return $e->getMessage();
    //     }
    //     return $this->returnSuccessMassage('your reset code was sent to your email');
    // }

    // public function verifyResetPassword(UserResetPasswordRequest2 $request)
    // {

    //     try {

    //         // find the code
    //         $passwordReset = PasswordReset::where(['code' => $request->code])->first();

    //         // check if it does not expired: the time is one hour
    //         if ($passwordReset->created_at > now()->addHour()) {
    //             $passwordReset->delete();
    //             return $this->returnError('', __('api.Code has been expired'));
    //         }

    //         return $this->returnSuccessMassage('right code');
    //     } catch (\Exception $e) {
    //         return $this->returnError('', __('site.something went wrong'));
    //     }
    // }

    // public function verifyResetPasswordChange(UserResetPasswordRequest3 $request)
    // {
    //     $passwordReset = PasswordReset::where('code', $request->code);

    //     // find user's email
    //     $user = User::firstWhere('email', $passwordReset->first()->email);

    //     //    update user password
    //     $user->update([
    //         'password' => bcrypt($request->password),
    //     ]);

    //     // delete current code
    //     $passwordReset->delete();

    //     return $this->returnData('data', $user->token(), 'api.Password has been updated');
    // }

}
