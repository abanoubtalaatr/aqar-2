<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = City::query()->where('is_for_landing_page_in_app', 0);

        if ($request->filled('keyword')) {
            $search = $request->input('keyword');
            $query->where('name_ar', 'LIKE', "%{$search}%")
                ->orWhere('name_en', 'LIKE', "%{$search}%");
        }

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $cities = $query->paginate($perPage);

        return view('admin.city-articles.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.city-articles.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);
        $data['is_for_landing_page_in_app'] = 0;

        City::create($data);
        return redirect()->route('admin.cities-articles.index')->with('success', 'City added successfully');
    }

    public function edit(City $cities_article)
    {
        $city = $cities_article;

        return view('admin.city-articles.edit', compact('city'));
    }


    public function update(Request $request, City $cities_article)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $data['is_for_landing_page_in_app'] = 0; // Add the additional field

        $cities_article->update($data);
        return redirect()->route('admin.cities-articles.index')->with('success', 'City updated successfully');
    }

    public function destroy(City $cities_article)
    {
        $cities_article->delete();
        return 1;
    }
}
