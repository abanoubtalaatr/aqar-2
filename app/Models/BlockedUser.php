<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'blocked_user_id'];
    /**
     * Checks if a user is blocked by another user.
     *
     * @param int $userId The user who may be blocking the other user.
     * @param int $otherUserId The user who may be blocked by the other user.
     *
     * @return bool True if the user is blocked by the other user, false if not.
     */
    public static function isBlocked($userId, $otherUserId): bool
    {
        return self::query()
            ->where(function ($query) use ($userId, $otherUserId) {
                $query->where('user_id', $userId)
                      ->where('blocked_user_id', $otherUserId);
            })
            ->orWhere(function ($query) use ($userId, $otherUserId) {
                $query->where('user_id', $otherUserId)
                      ->where('blocked_user_id', $userId);
            })
            ->exists();
    }
}
