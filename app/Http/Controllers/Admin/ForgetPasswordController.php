<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForgetPassword;
use App\Http\Requests\Admin\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    protected $view = "admin.auth.";

    public function forgetPassword()
    {
        return view("{$this->view}forget-password");
    }

    public function resetPassword($token)
    {
        return view("{$this->view}reset-password", compact('token'));
    }

    public function submitForgetPassword(ForgetPassword $request)
    {
        $token = Str::random(64);
        $exists = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if ($exists) {
            DB::table('password_reset_tokens')->where('email', $request->email)->update(['token' => $token]);

        } else {
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
        }

        // try {
        Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject(__('Reset Password'));
        });
        return back()->with('success', __('We have e-mailed your password reset link!'));
        // } catch (Exception $ex) {
        //     return back()->with('error', __('Something wrong happened, please try again later!'))->withInput();
        // }

    }

    public function submitResetPassword(ResetPassword $request)
    {
        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect()->route('admin.login')->with('success', __('Your password has been changed!'));
    }
}
