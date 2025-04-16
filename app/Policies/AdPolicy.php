<?php

namespace App\Policies;

use App\Models\Ad;
use App\Models\User;

class AdPolicy
{
    public function show(User $user, Ad $ad)
    {
        if ($ad->user_id !== $user->id) {
            return false;
        }

        return true;
    }
    public function delete(User $user, Ad $ad)
    {
        // Check if the ad belongs to the user
        if ($ad->user_id !== $user->id) {
            return false;
        }

        // Additional checks, e.g., if there are associated chats
        if ($ad->chats()->exists()) {
            return false;
        }

        return true;
    }
}
