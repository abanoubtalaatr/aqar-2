<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Models\Ad;
use App\Models\Category;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    public function show(Ad $ad)
    {
        return view('admin.ads.show', compact('ad'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.ads.create', compact('categories'));
    }
    public function destroy(Ad $ad)
    {
        $ad->delete();

        return 1;
    }
}
