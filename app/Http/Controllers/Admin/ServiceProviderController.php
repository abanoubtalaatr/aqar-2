<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceProviderController extends Controller
{
    // Display a listing of service providers
    public function index(Request $request)
    {
        $query = ServiceProvider::with('serviceType');

        // Search by keyword (emails)
        if ($keyword = $request->input('keyword')) {
            $query->where('emails', 'like', "%{$keyword}%");
        }

        // Filter by service type
        if ($serviceTypeId = $request->input('service_type_id')) {
            $query->where('service_type_id', $serviceTypeId);
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $serviceProviders = $query->paginate($perPage)->appends($request->except('page'));

        $serviceTypes = ServiceType::all();

        return view('admin.service-providers.index', compact('serviceProviders', 'serviceTypes'));
    }

    // Show the form for creating a new service provider
    public function create()
    {
        $serviceTypes = ServiceType::all();
        return view('admin.service-providers.create', compact('serviceTypes'));
    }

    // Store a newly created service provider
    public function store(Request $request)
    {
        $request->validate([
            'service_type_id' => 'required|exists:service_types,id',
            'emails' => 'required|string',
        ]);

        ServiceProvider::create([
            'service_type_id' => $request->service_type_id,
            'emails' => $request->emails,
            'is_active' => 1, // Default active
        ]);

        return redirect()->route('admin.service-providers.index')->with('success', 'Service Provider created successfully.');
    }

    // Show the form for editing a service provider
    public function edit(ServiceProvider $serviceProvider)
    {
        $serviceTypes = ServiceType::all();
        return view('admin.service-providers.edit', compact('serviceProvider', 'serviceTypes'));
    }

    // Update an existing service provider
    public function update(Request $request, ServiceProvider $serviceProvider)
    {
        $request->validate([
            'service_type_id' => 'required|exists:service_types,id',
            'emails' => 'required|string',
        ]);

        $serviceProvider->update([
            'service_type_id' => $request->service_type_id,
            'emails' => $request->emails,
        ]);

        return redirect()->route('admin.service-providers.index')->with('success', 'Service Provider updated successfully.');
    }

    // Delete a service provider
    public function destroy(ServiceProvider $serviceProvider)
    {
        $serviceProvider->delete();
        return redirect()->route('admin.service-providers.index')->with('success', 'Service Provider deleted successfully.');
    }

    // Toggle status (active/inactive)
    public function statusChange(Request $request)
    {
        $serviceProvider = ServiceProvider::findOrFail($request->item);
        $serviceProvider->is_active = !$serviceProvider->is_active;
        $serviceProvider->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
