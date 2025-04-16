<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceType::query();
        $serviceTypes = ServiceType::whereIsActive(1)->get();

        if ($request->keyword) {
            $query->where('name_ar', 'like', '%' . $request->keyword . '%')
                  ->orWhere('name_en', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $service_types = $query->latest()->paginate($perPage);

        return view('admin.service-types.index', compact('service_types', 'serviceTypes'));
    }

    public function create()
    {
        return view('admin.service-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'type' => 'required', // Add your valid types
        ]);

        ServiceType::create($request->all());

        return redirect()->route('admin.service-types.index')
                        ->with('success', 'Service Type created successfully');
    }

    public function edit(ServiceType $service_type)
    {
        return view('admin.service-types.edit', compact('service_type'));
    }

    public function update(Request $request, ServiceType $service_type)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'type' => 'required', // Add your valid types
        ]);

        $service_type->update($request->all());

        return redirect()->route('admin.service-types.index')
                        ->with('success', 'Service Type updated successfully');
    }

    public function destroy(ServiceType $service_type)
    {
        $service_type->delete();

        return 1;
    }
}
