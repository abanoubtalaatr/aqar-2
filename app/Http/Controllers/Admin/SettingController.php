<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    protected $view = "admin.settings.";

    public function index()
    {
        $groups = Setting::groupBy('group')->select('group', DB::raw('count(*) as total'))->get();

        $items = Setting::orderby('sort', 'asc')->get();
        return view("{$this->view}index", compact('items', 'groups'));
    }

    public function update(SettingRequest $request)
    {
        $items = Setting::all();
        foreach ($items as $k => $item) {
            $key = $item->key;
            $value = $request->input($key);

            $setting = Setting::where('key', $key)->first();
            if ($setting->type == 'password' && $value == null) {
                $value = $setting->value;
            } elseif ($setting->type == 'password' && $value != null) {
                $value = Hash::make($value);
            }

            if ($setting->type == 'file' && $request->hasFile($key)) {
                $file = $request->file($key);
                $path = $file->store('uploads', 'public'); // Store in 'public/uploads'
                $value = $path; // Store the file path in the database
            }

            // if ($value) {
            Setting::where('key', $key)->update(['value' => $value]);
            // }
        }
        return back()->with('success', __('dashboard.Data updated successfully!'));
    }

}
