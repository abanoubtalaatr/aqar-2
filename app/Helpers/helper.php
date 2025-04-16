<?php

use App\Models\Page;
use App\Models\Setting;

if (!function_exists('dashboardAsset')) {
    function dashboardAsset($file)
    {
        return asset('dashboard/' . $file);
    }
}

if (!function_exists('perPages')) {
    function perPages()
    {
        $items = [5, 10, 15, 25, 30];
        return $items;
    }
}

if (!function_exists('groupSettings')) {
    function groupSettings($group)
    {
        $items = Setting::where('group', $group)->get();

        return $items;
    }
}
if (!function_exists('myLang')) {
    function myLang()
    {
        return app()->getLocale();
    }
}

if (!function_exists('countryFlag')) {
    function countryFlag($currentLang)
    {
        $flag = "us";
        if ($currentLang == 'ar') {
            $flag = "sa";
        }

        return "<span class='fi fi-" . $flag . "'></span>";
    }
}
if (!function_exists('activeTab')) {
    function activeTab($request)
    {
        if (\Illuminate\Support\Facades\Request::routeIs($request) || request()->is($request)) {
            return 'active';
        }
        return '';
    }
}
if (!function_exists('has_permission')) {
    function has_permission($permission)
    {


        return true;
    }
}
if (!function_exists('openTab')) {
    function openTab($request)
    {
        if (\Illuminate\Support\Facades\Request::routeIs($request) || request()->is($request)) {
            return 'menu-open';
        }
        return '';
    }
}
if (!function_exists('pages')) {
    function pages()
    {
        $items = Page::where('key', '!=', 'how_we_work')->get();
        return $items;
    }
}

if (!function_exists('page')) {
    function page($slug)
    {
        $item = Page::where('key', $slug)->first();
        return $item ?? null;
    }
}
