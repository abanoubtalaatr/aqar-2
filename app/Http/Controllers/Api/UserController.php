<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\GeneralTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Services\FileManagementService;
use App\Http\Resources\Api\LoginResource;
use App\Http\Resources\Api\ProfileResource;
use App\Http\Requests\Api\UpdateProfileRequest;

class UserController extends Controller
{
    use GeneralTrait;
    use FileManagementService;

    public function profile()
    {

        $user = new ProfileResource(JWTAuth::user());
        // $user_ads = AdProfileResource::collection(JWTAuth::user()->ads()->orderBy('created_at', 'desc')->paginate(5))->response()->getData(true);
        // $followers = User::find(JWTAuth::user()->id)->followers;
        // $followers = UserResource::collection($followers);
        $userResource = new LoginResource($user);

        return $this->returnData('data', $userResource);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->except('old_password', 'new_password', 'new_password_confirmation');
        $user = User::where('id', JWTAuth::user()->id)->first();

        if ($request->filled('old_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return $this->returnError(422, __("mobile.Wrong old password"));
            }
            $data['password'] = $request->new_password;
        }

        if ($request->hasFile('avatar')) {

            $user->avatar ? $this->remove_file($user->avatar) : '';

            $data['avatar'] = $this->upload_file($request->file('avatar'), 'users');
        }
        $user->update($data);

        return $this->returnData('data', new LoginResource($user), __('mobile.Updated successfully.'));
    }

    public function deleteAccount()
    {
        $user = User::where('id', JWTAuth::user()->id)->first();

        $user->delete();

        return $this->returnSuccessMassage(__('mobile.Account have been deleted.'));
    }
}
