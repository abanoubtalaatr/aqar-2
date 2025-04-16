<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // Search by user name
        if ($request->filled('keyword')) {
            $search = $request->input('keyword');
            $query->where('name_ar', 'LIKE', "%{$search}%")->orWhere('name_en', 'LIKE', "%{$search}%");
        }

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $categories = $query->paginate($perPage);

        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }
}
