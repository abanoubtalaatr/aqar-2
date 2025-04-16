<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RateRequest;
use App\Models\Rate;
use App\Traits\GeneralTrait;

class RateController extends Controller
{
    use GeneralTrait;

    public function store(RateRequest $request)
    {
        $user_id = auth()->guard('api')->user()->id;
        $rate = Rate::where('user_id', $user_id)->first();
        if ($rate) {
            $rate->update(['rate' => $request->rate]);

            return $this->returnSuccessMassage(__('site.recored updated successfully.'));
        } else {
            Rate::create([
                'user_id' => $user_id,
                'rate' => $request->rate,
            ]);

            return $this->returnSuccessMassage(__('site.recored created successfully.'));
        }
    }
}
