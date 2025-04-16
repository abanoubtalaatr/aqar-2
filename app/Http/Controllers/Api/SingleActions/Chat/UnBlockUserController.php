<?php

namespace App\Http\Controllers\Api\SingleActions\Chat;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Models\User;

class UnBlockUserController extends Controller
{
    use GeneralTrait;
    /**
     * Unblocks the specified user by deleting the BlockedUser entry.
     *
     * @param \App\Models\User $user The user to be unblocked.
     *
     * @return \Illuminate\Http\JsonResponse Returns a success message if the user is unblocked.
     */
    public function __invoke(User $user)
    {
        \App\Models\BlockedUser::where('user_id', auth()->id())
            ->where('blocked_user_id', $user->id)
            ->delete();

        return $this->returnSuccessMessage(__("mobile.unblocked.'"));
    }
}
