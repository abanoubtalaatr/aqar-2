<?php

namespace App\Services\General;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteService
{
    /**
     * Check if the current user has already favorited an item.
     *
     * @param int $favoritableId
     * @param string $favoritableType
     * @return bool
     */
    public static function isFavorited(int $favoritableId, string $favoritableType): bool
    {
        $user = Auth::user();

        $fullModelName = static::resolveModelName($favoritableType);

        if ($user) {
            return Favorite::where('user_id', $user->id)
            ->where('favoritable_id', $favoritableId)
            ->exists();
        }
        return false;
    }

    /**
     * Resolve the full class name for the favoritable type.
     *
     * @param string $favoritableType
     * @return string
     */
    private static function resolveModelName(string $favoritableType): string
    {
        $validTypes = [
            'Order' => "App\Models\Order",
            'Ad' => "App\Models\Ad",
        ];

        return $validTypes[$favoritableType];
    }
}
