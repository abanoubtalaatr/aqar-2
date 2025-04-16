<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index(Request $request)
    {
        $query = License::with('user');

        // Search by user name
        if ($request->filled('keyword')) {
            $search = $request->input('keyword');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('license_status')) {
            $query->where('status', $request->input('license_status'));
        }

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $licenses = $query->paginate($perPage);

        return view('admin.licenses.index', compact('licenses'));
    }


    public function create()
    {
        return view('admin.licenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'file' => 'nullable|file',
        ]);

        $license = new License($request->all());
        if ($request->hasFile('file')) {
            $license->file = $request->file('file')->store('licenses');
        }
        $license->save();

        return redirect()->route('admin.licenses.index')->with('success', 'License created successfully.');
    }

    public function edit(License $license)
    {
        return view('admin.licenses.edit', compact('license'));
    }

    public function update(Request $request, License $license)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'file' => 'nullable|file',
        ]);

        if ($request->hasFile('file')) {
            $license->file = $request->file('file')->store('licenses');
        }
        $license->update($request->except('file'));

        return redirect()->route('admin.licenses.index')->with('success', 'License updated successfully.');
    }

    public function destroy(License $license)
    {
        $license->delete();

        return 1;
    }

    public function changeStatus(License $license, $status)
    {

        // Validate the status
        if (!in_array($status, ['active', 'rejected','pending'])) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        // Update the license status
        $license->status = $status;
        $license->save();

        return redirect()->back()->with('success', 'License status updated successfully.');
    }
}
