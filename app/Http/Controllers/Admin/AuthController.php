<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $view = "admin.auth.";

    public function login()
    {

        return view("{$this->view}login");
    }

    public function submitLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember_me)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Check if the user has ANY role or ANY permission
            if ($user->roles->isEmpty() && $user->permissions->isEmpty()) {
                Auth::logout();
                return redirect()->route('admin.login')->with('error', __('dashboard.You do not have permission to access the admin panel.'));
            }

            if (!$user->is_active) {
                Auth::logout();
                return redirect()->route('admin.login')->with('error', __('dashboard.Your account now is suspended.'));
            }

            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login')->with('error', __('dashboard.Password is incorrect. Please check and re-enter!'));
    }
}
