<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use App\Models\ContactService;
use App\Models\ServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactServiceNotification;
use App\Http\Requests\Api\ContactServiceRequest;

class ContactServiceController extends Controller
{
    use GeneralTrait;

    public function store(ContactServiceRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;


        $contact = ContactService::create($data);

        $userSuspendBefore = ContactService::where('user_id', auth()->id())->where('is_active', 1)->first();

        // Get service provider with matching service_type_id
        $serviceProvider = ServiceProvider::where('service_type_id', $data['service_type_id'])->first();

        if (!$userSuspendBefore) {
            if ($serviceProvider && $serviceProvider->emails) {
                // Split the comma-separated emails into an array
                $emails = array_map('trim', explode(',', $serviceProvider->emails));

                // Send email to each valid address
                foreach ($emails as $email) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        Mail::to($email)->send(new ContactServiceNotification($contact));
                    }
                }
            }
        }

        return $this->returnData('data', [], __('mobile.Sent Successfully'));
    }
}
