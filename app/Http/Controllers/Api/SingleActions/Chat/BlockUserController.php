<?php

namespace App\Http\Controllers\Api\SingleActions\Chat;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Models\User;

class BlockUserController extends Controller
{
    use GeneralTrait;
    /**
     * Blocks the specified user by creating a BlockedUser entry.
     *
     * @param \App\Models\User $user The user to be blocked.
     *
     * @return \Illuminate\Http\JsonResponse Returns a success message if the user is blocked,
     * or an error message if the user tries to block themselves.
     */
    public function __invoke(User $user)
    {
        if (auth()->id() == $user->id) {
            return $this->returnError(400, __("mobile.'You cannot block yourself.'"));
        }

        \App\Models\BlockedUser::create([
            'user_id' => auth()->id(),
            'blocked_user_id' => $user->id,
        ]);

        return $this->returnSuccessMessage(__("mobile.blocked.'"));
    }
}
