<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function load_states(Request $request)
    {
        $country_id = $request->input('country_id');
        $items = State::where('country_id', $country_id)->active()->orderBy('name', 'desc')->get();

        // Return JSON response with states
        return response()->json(['options' => $items]);
    }

    public function load_cities(Request $request)
    {
        $state_id = $request->input('state_id');
        $items = City::where('state_id', $state_id)->active()->orderBy('name', 'desc')->get();

        // Return JSON response with states
        return response()->json(['options' => $items]);
    }


    public function load_categories(Request $request)
    {
        $industry_id = $request->input('industry_id');
        $options = "<option value=''>" . __('Choose Category') . "</option>";
        $items = Category::where('industry_id', $industry_id)->active()->orderby('name_' . myLang(), 'desc')->get();
        foreach ($items as $item) {
            $name = myLang() == 'ar' ? $item->name_ar : $item->name;
            $options .= "<option value='" . $item->id . "'> " . $name . " </option>";
        }

        return $options;
    }
}
