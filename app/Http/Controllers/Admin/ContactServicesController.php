<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactService; // Assuming this is your model

class ContactServicesController extends Controller
{
    /**
     * Display a listing of contact services.
     */
    public function index(Request $request)
    {
        // Query for contact services
        $query = ContactService::with(['user', 'serviceType']);

        // Filter by keyword
        if ($keyword = $request->input('keyword')) {
            $query->whereHas('user', function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('phone', 'like', "%{$keyword}%");
            })->orWhere('message', 'like', "%{$keyword}%");
        }

        // Filter by main service type (engineering, decoration, construction)
        if ($mainType = $request->input('main_type')) {
            $query->whereHas('serviceType', function ($q) use ($mainType) {
                $q->where('type', $mainType);
            });
        }

        // Filter by sub-service type (by ID)
        if ($subType = $request->input('sub_type')) {
            $query->where('service_type_id', $subType);
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $contact_services = $query->paginate($perPage);

        // Get sub-service types based on main type filter
        $subQuery = ServiceType::whereIn('type', ['engineering', 'decoration', 'construction']);
        if ($mainType) {
            $subQuery->where('type', $mainType);
        }
        $subServiceTypes = $subQuery->get();

        return view('admin.contact-services.index', compact('contact_services', 'subServiceTypes'));
    }

    /**
     * Show the form for creating a new contact service.
     */
    public function create()
    {
        return view('admin.contact-services.create');
    }

    /**
     * Store a newly created contact service in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_type_id' => 'required|exists:service_types,id',
            'message' => 'required|string|max:255',
            'share_with' => 'required|string|max:100',
        ]);

        ContactService::create($validated);

        return redirect()->route('admin.contact-services.index')
            ->with('success', __('dashboard.Contact service created successfully'));
    }

    /**
     * Remove the specified contact service from storage.
     */
    public function destroy(ContactService $contact_service)
    {
        $contact_service->delete();

        return 1;
    }

    /**
     * Show the form for replying to a contact service.
     */
    public function reply(ContactService $contact_service)
    {
        return view('admin.contact-services.reply', compact('contact_service'));
    }

    /**
     * Handle the reply submission.
     */
    public function storeReply(Request $request, ContactService $contact_service)
    {
        $validated = $request->validate([
            'reply_message' => 'required|string|max:255',
        ]);

        // Here you could save the reply to a related table (e.g., ContactServiceReply)
        // For simplicity, I'll assume a hypothetical implementation
        $contact_service->update([
            'reply_message' => $validated['reply_message'],
        ]);

        return redirect()->route('admin.contact-services.index')
            ->with('success', __('dashboard.Reply sent successfully'));
    }
}
