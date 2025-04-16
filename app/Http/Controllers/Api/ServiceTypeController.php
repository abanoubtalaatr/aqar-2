<?php

namespace App\Http\Controllers\Api;

use App\Models\ServiceType;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ServiceTypeResource;

class ServiceTypeController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        if ($request->filled('type')) {
            return $this->returnData('data', ServiceTypeResource::collection(ServiceType::where('type', $request->type)->get()));
        }
        return $this->returnData('data', [], 'should provide type');
    }
}
