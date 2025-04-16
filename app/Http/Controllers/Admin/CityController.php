<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $query = City::query()->where('is_for_landing_page_in_app', 1);

        if ($request->filled('keyword')) {
            $search = $request->input('keyword');
            $query->where('name_ar', 'LIKE', "%{$search}%")
                  ->orWhere('name_en', 'LIKE', "%{$search}%");
        }

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $cities = $query->paginate($perPage);

        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'latitude_min' => 'required|numeric',
            'latitude_max' => 'required|numeric',
            'longitude_min' => 'required|numeric',
            'longitude_max' => 'required|numeric',
            'latitude_center' => 'required|numeric',
            'longitude_center' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        City::create($request->all());
        return redirect()->route('admin.cities.index')->with('success', 'City added successfully');
    }

    public function edit(City $city)
    {
        return view('admin.cities.edit', compact('city'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'latitude_min' => 'required|numeric',
            'latitude_max' => 'required|numeric',
            'longitude_min' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'longitude_max' => 'required|numeric',
            'latitude_center' => 'required|numeric',
        'longitude_center' => 'required|numeric',
        ]);

        $city->update($request->all());
        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return 1;
    }
}
