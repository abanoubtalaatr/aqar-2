<?php

namespace App\Services\General;

use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowingService
{
    /**
     * Check if the authenticated user follows another user.
     *
     * @param int $userId      The ID of the user performing the check.
     * @param int $followingId The ID of the user being checked.
     * @return bool            True if the user is following the other user, false otherwise.
     */
    public static function isFollow($followingId)
    {
        // Ensure there's an authenticated user
        if (Auth::check()) {

            // Check if the authenticated user is following the given user
            return Follow::where('followed_id', $followingId)->where("follower_id", Auth::id())
                ->exists();
        }

        return false; // Not authenticated, so return false.
    }
}
