<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\UpdatePasswordRequest;

class UpdatePasswordController extends Controller
{
    use GeneralTrait;

    public function __invoke(UpdatePasswordRequest $request)
    {
        $user = $request->user();
        if (!Hash::check($request->old_password, $user->password)) {
            return $this->returnError(422, __("mobile.Wrong old password"));
        }

        $user->password = $request->new_password;
        $user->save();

        return $this->returnSuccessMessage(__('mobile.Password updated successfully.'));
    }
}
