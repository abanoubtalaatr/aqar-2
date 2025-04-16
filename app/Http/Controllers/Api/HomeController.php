<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SinglePageResource;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Page;
use App\Traits\GeneralTrait;

class HomeController extends Controller
{
    use GeneralTrait;

    public function page($id)
    {
        $page = Page::find($id);
        $page_data = new SinglePageResource($page);

        return $this->returnData('data', $page_data);
    }

    public function index()
    {
        $cats = Category::get();
        $categories_data = CategoryResource::collection($cats);

        return $this->returnData('data', $categories_data);
    }

    public function contact(ContactRequest $request)
    {
        try {
            $contact = Contact::create($request->input());
            $this->send_notii('contactNotification', $contact, 'browse_contact', $request['name']);

            return $this->returnSuccessMassage(__('api.Sent Successfully'), 200);
        } catch (\Exception $e) {
            return $this->returnError('', 'some thing went wrong');
        }
    }
}
