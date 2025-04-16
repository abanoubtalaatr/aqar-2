<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactType; // Assuming this is your model
use Illuminate\Http\Request;

class ContactTypesController extends Controller
{
    /**
     * Display a listing of contact types.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $query = ContactType::query();

        if ($keyword) {
            $query->where('name_ar', 'like', "%{$keyword}%")
                  ->orWhere('name_en', 'like', "%{$keyword}%")
                  ->orWhere('type', 'like', "%{$keyword}%");
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        $contact_types = $query->orderBy('id', 'desc')->paginate($perPage);

        return view('admin.contact-types.index', compact('contact_types'));
    }

    /**
     * Show the form for creating a new contact type.
     */
    public function create()
    {
        return view('admin.contact-types.create');
    }

    /**
     * Store a newly created contact type in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'type' => 'required|in:support,help',
        ]);

        ContactType::create($validated);

        return redirect()->route('admin.contact-types.index')
                         ->with('success', __('dashboard.Contact type created successfully'));
    }

    /**
     * Show the form for editing the specified contact type.
     */
    public function edit(ContactType $contact_type)
    {
        return view('admin.contact-types.edit', compact('contact_type'));
    }

    /**
     * Update the specified contact type in storage.
     */
    public function update(Request $request, ContactType $contact_type)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'type' => 'required|in:support,help',
        ]);

        $contact_type->update($validated);

        return redirect()->route('admin.contact-types.index')
                         ->with('success', __('dashboard.Contact type updated successfully'));
    }

    /**
     * Remove the specified contact type from storage.
     */
    public function destroy(ContactType $contact_type)
    {
        $contact_type->delete();
        return 1;
    }
}
