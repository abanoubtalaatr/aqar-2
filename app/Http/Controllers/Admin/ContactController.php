<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\ContactType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactResponseMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contactTypes = ContactType::all();

        $query = Contact::with('user', 'contactType');

        if ($request->has('filter_type') && !empty($request->filter_type)) {
            $query->whereHas('contactType', function ($q) use ($request) {
                $q->where('type', $request->filter_type);
            });
        }

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $contacts = $query->latest()->paginate($perPage);

        return view('admin.contacts.index', compact('contacts', 'contactTypes'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate([
            'response_message' => 'required|string',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->response_message = $request->response_message;
        $contact->save();

        // Send email if user has an email
        if ($contact->user && $contact->user->email) {
            Mail::to($contact->user->email)->send(new ContactResponseMail($contact));
        }

        return redirect()->route('admin.contacts.index')->with('success', 'dashboard.Response sent successfully, and email notification sent.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return 1;
    }
}
