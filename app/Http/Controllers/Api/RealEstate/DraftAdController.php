<?php

namespace App\Http\Controllers\Api\RealEstate;

use App\Models\Ad;
use App\Filters\AdFilters;
use App\Constants\AdStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AdResource;
use App\Traits\GeneralTrait;

class DraftAdController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        $query = Ad::active()
        ->where('user_id', auth()->id())
        ->hasCategory()
        ->where('status', AdStatus::DRAFT)
        ->hasLicenseNumber()
        ->isPublished()
        ->orderBy('created_at', 'desc');

        $query = (new AdFilters($request))->apply($query);

        $ads = $request->has('paginate') ? $query->get() : $query->paginate(6);

        return $this->returnData('data', AdResource::collection($ads));
    }
}
