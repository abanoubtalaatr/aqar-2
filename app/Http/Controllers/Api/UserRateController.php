<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RateUserRequest;
use App\Models\Rate;
use App\Traits\GeneralTrait;

class UserRateController extends Controller
{
    use GeneralTrait;

    public function store(RateUserRequest $request)
    {
        $rater = auth()->user();
        Rate::updateOrCreate([
            'user_id' => $request->user_id,
            'rater_id' => $rater->id,

        ], [
            'rate' => $request->rate,
        ]);
        if (Rate::where(['rater_id' => $rater->id, 'user_id' => $request->user_id])->exists()) {
            return $this->returnSuccessMassage(__('site.recored updated successfully.'));
        } else {
            return $this->returnSuccessMassage(__('site.recored created successfully.'));
        }
    }
}
