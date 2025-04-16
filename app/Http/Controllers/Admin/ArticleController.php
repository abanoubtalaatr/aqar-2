<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('city');

        // Search by title_ar or title_en
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title_ar', 'LIKE', "%{$search}%")
                  ->orWhere('title_en', 'LIKE', "%{$search}%");
            });
        }

        // Filter by city_id
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->input('city_id'));
        }
        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $articles = $query->latest()->paginate($perPage);
        $cities  = City::where('is_active', 1)->where('is_for_landing_page_in_app', 0)->get();

        return view('admin.articles.index', compact('articles', 'cities'));
    }

    public function create()
    {
        $cities = City::where('is_active', 1)->where('is_for_landing_page_in_app', 0)->get();
        return view('admin.articles.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $article = new Article($request->except('image'));

        if ($request->hasFile('image')) {
            $article->image = $request->file('image')->store('articles', 'public');
        }

        $article->save();

        return redirect()->route('admin.articles.index')->with('success', __('dashboard.Article created successfully.'));
    }

    public function edit(Article $article)
    {
        $cities = City::where('is_active', 1)->where('is_for_landing_page_in_app', 0)->get();
        return view('admin.articles.edit', compact('article', 'cities'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $article->fill($request->except('image'));

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $article->image = $request->file('image')->store('articles', 'public');
        }

        $article->save();

        return redirect()->route('admin.articles.index')->with('success', __('dashboard.Article updated successfully.'));
    }

    public function destroy(Article $article)
    {
        // Delete image if exists
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return 1;
    }

    public function changeStatus(Article $article)
    {
        $article->is_active = !$article->is_active;
        $article->save();

        return redirect()->back()->with('success', 'Article status updated successfully.');
    }
}
