<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\RandomMessage;
use App\Http\Controllers\Controller;

class RandomMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = RandomMessage::query();

        if ($request->filled('keyword')) {
            $query->where('name_ar', 'like', '%' . $request->keyword . '%')
                  ->orWhere('name_en', 'like', '%' . $request->keyword . '%');
        }

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $items = $query->orderBy('id', 'DESC')->paginate($perPage);

        return view('admin.random-messages.index', compact('items'));
    }

    public function create()
    {
        return view('admin.random-messages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        RandomMessage::create($request->only(['name_ar', 'name_en']));

        return redirect()->route('admin.random-messages.index')->with('success', __('dashboard.Random message added successfully!'));
    }

    public function edit(RandomMessage $randomMessage)
    {
        return view('admin.random-messages.edit', compact('randomMessage'));
    }

    public function update(Request $request, RandomMessage $randomMessage)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);

        $randomMessage->update($request->only(['name_ar', 'name_en']));

        return redirect()->route('admin.random-messages.index')->with('success', __('dashboard.Random message updated successfully!'));
    }

    public function destroy(RandomMessage $random_message)
    {
        $random_message->delete();
        return 1;

        return redirect()->route('admin.random-messages.index')->with('success', __("dashboard.Random message deleted successfully!"));
    }
}
