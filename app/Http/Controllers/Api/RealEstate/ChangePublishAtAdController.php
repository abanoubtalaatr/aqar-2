<?php

namespace App\Http\Controllers\Api\RealEstate;

use App\Models\Ad;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ChangePublishAtAdController extends Controller
{
    use GeneralTrait;

    public function __invoke(Request $request, Ad $real_estate)
    {
        $real_estate->update(['published_at' => now(), 'is_updated' => 1, 'change_published_at' => now()]);

        return $this->returnData('data', [], __("mobile.Updated successfully."));
    }
}
