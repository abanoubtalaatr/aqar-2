<?php

namespace App\Http\Controllers\Api;

use App\Models\ContactType;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ContactTypeResource;

class ContactTypeController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        if ($request->filled('type') && $request->type == 'support') {
            return $this->returnData('data', ContactTypeResource::collection(ContactType::where('type', 'support')->get()));
        }

        return $this->returnData('data', ContactTypeResource::collection(ContactType::where('type', 'help')->get()));
    }
}
