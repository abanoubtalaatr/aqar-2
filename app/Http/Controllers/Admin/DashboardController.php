<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Report;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\ProfileRequest;
use App\Http\Requests\Admin\ChangePasswordRequest;

class DashboardController extends Controller
{
    protected $userRepository;

    protected $google;
    protected $view = "admin.dashboard.";
    protected $tbl = "users";
    protected $skipped = [
        "id",
        "created_at",
        "updated_at",
        "type",
        "email_verified_at",
        "remember_token",
        "password",
        "is_active",
        "is_verified",
        "otp",
        "otp_expires_at",
        "birth_date",
        "lat",
        "lng",
        "device_token",
        "location",
    ];

    protected $skippedAdmin = [
        "id",
        "created_at",
        "updated_at",
        "type",
        "email_verified_at",
        "remember_token",
        "password",
        "is_active",
        "is_verified",
        "otp",
        "otp_expires_at",
        "birth_date",
        "location",
        "lat",
        "lng",
        "device_token",
        "otp_token",
    ];

    protected $required = ["name", "email", "mobile"];



    public function index(Request $request)
    {
        $users = User::doesntHave('roles')->count();
        $admins = User::whereHas('roles')->count();

        $rentAdsPerDayOrMonthCount = Ad::where('per_day_or_month', 1)->count();
        $rentAdsCount = Ad::where('for_rent', 1)->count();
        $sellAdsCount = Ad::where('for_rent', 0)->orWhereNull('for_rent')->count();
        $sellOrdersCount = Order::where('for_rent', 0)->orWhereNull('for_rent')->count();
        $rentOrdersCount = Order::where('for_rent', 1)->orWhereNull('for_rent')->count();
        $categories = Category::count();
        $cities = City::count();
        $reportAds = Report::whereNotNull('ad_id')->whereNull('order_id')->count();
        $reportOrders = Report::whereNotNull('order_id')->whereNull('ad_id')->count();
        $serviceProviders = ServiceProvider::count();

        return view("{$this->view}index", compact(
            'users',
            'admins',
            'rentAdsPerDayOrMonthCount',
            'rentAdsCount',
            'sellAdsCount',
            'sellOrdersCount',
            'rentOrdersCount',
            'categories',
            'cities',
            'reportAds',
            'reportOrders',
            'serviceProviders'
        ));
    }

    public function updateProfile(ProfileRequest $request)
    {
        // dd($request);
        if ($request->old_password || $request->password || $request->password_confirmation) {
            $user_id = auth()->user()->id;
            $hashedPassword = Auth::user()->password;
            if (!Hash::check($request->old_password, $hashedPassword)) {
                return back()->with('error', trans('old_password_is_Wrong'));
            }
            if (Hash::check($request->password, $hashedPassword)) {
                return back()->with('error', trans('new_password_can_not_be_the_old_password'));
            } else {
                $update = User::find($user_id)->update(['password' => Hash::make($request->password)]);
                if (!$update) {
                    // return back()->with('success', trans('password_changed_successfully'));
                    return back()->with('error', __('Failed to save data!'));
                }
            }
        }

        $model = $this->userRepository->update($request->validated(), auth()->user());
        if ($model) {
            return back()->with('success', __('Data updated successfully!'));
        }
        return back()->with('error', __('Failed to save data!'))->withInput();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user_id = auth()->user()->id;
        $hashedPassword = Auth::user()->password;
        // dd($request->all());
        if (!Hash::check($request->old_password, $hashedPassword)) {
            return back()->with('error', trans('old_password_is_Wrong'));
        }
        if (Hash::check($request->password, $hashedPassword)) {
            return back()->with('error', trans('new_password_can_not_be_the_old_password'));
        } else {
            $update = User::find($user_id)->update(['password' => Hash::make($request->password)]);
            if ($update) {
                return back()->with('success', trans('password_changed_successfully'));
            }
            return back()->with('error', __('Failed to save data!'));
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin.login');
    }


    public function status_change($model, $id)
    {
        $modelClass = 'App\\Models\\' . $model;
        $modelInstance = app($modelClass);

        $item = $modelInstance::find($id);
        $item->is_active = !$item->is_active;
        $item->save();

        // if($model == '')
        return 1;
    }
}
