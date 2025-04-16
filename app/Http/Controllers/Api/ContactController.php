<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;

class ContactController extends Controller
{
    use GeneralTrait;
    public function store(ContactRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        $contact = Contact::create($data);

        return $this->returnData('data', [], __('mobile.Sent Successfully'));
    }
}
