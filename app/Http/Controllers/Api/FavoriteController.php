<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FavoriteRequest;
use App\Http\Resources\Api\FavoriteResource;

class FavoriteController extends Controller
{
    use GeneralTrait;

    public function favoritesForItem(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|in:Order,Ad', // Validate type is either 'Order' or 'Ad'
        ]);

        // Map the type to its corresponding model
        $favoritableType = $request->type === 'Order'
            ? "App\\Models\\Order"
            : "App\\Models\\Ad";

        // Fetch all users who have favorited this specific item
        $favorites = Favorite::with('user', 'favoritable')
            ->where('favoritable_id', $id)
            ->where('favoritable_type', $favoritableType)
            ->get();

        return $this->returnData('data', FavoriteResource::collection($favorites), 'Saved for the item retrieved successfully');
    }


    public function myFavorites(Request $request)
    {
        $user = $request->user();
        $query = Favorite::with('favoritable')
            ->where('user_id', $user->id);

        // Filter by type if provided in the request
        if ($request->has('type')) {
            $type = $request->input('type');
            if ($type === 'ads') {
                $query->where('favoritable_type', 'App\\Models\\Ad');
            } elseif ($type === 'orders') {
                $query->where('favoritable_type', 'App\\Models\\Order');
            }
        }

        $favorites = $request->has('paginate') ? $query->paginate() : $query->get();

        // Get the paginated data from the FavoriteResource collection
        if ($request->has('paginate') && $request->input('paginate') == 1) {
            $favorites_data = FavoriteResource::collection($favorites)->response()->getData();
        } else {
            $favorites_data = FavoriteResource::collection($favorites);
        }

        // Dynamic success message based on filter
        $message = 'My favorites retrieved successfully';
        if ($request->has('type')) {
            $message = 'My ' . $request->input('type') . ' favorites retrieved successfully';
        }

        return $this->returnData('data', $favorites_data, $message);
    }
    public function myAdFavorites(Request $request)
    {
        $user = $request->user();
        $query = Favorite::with('favoritable')
            ->where('user_id', $user->id)
            ->where('favoritable_type', 'App\\Models\\Ad'); // Filter for Ads only

        $favorites = $request->has('paginate') ? $query->paginate() : $query->get();

        if ($request->has('paginate') && $request->input('paginate') == 1) {
            $favorites_data = FavoriteResource::collection($favorites)->response()->getData();
        } else {
            $favorites_data = FavoriteResource::collection($favorites);
        }

        return $this->returnData('data', $favorites_data, 'My Ad favorites retrieved successfully');
    }

    public function myOrderFavorites(Request $request)
    {
        $user = $request->user();
        $query = Favorite::with('favoritable')
            ->where('user_id', $user->id)
            ->where('favoritable_type', 'App\\Models\\Order'); // Filter for Orders only

        $favorites = $request->has('paginate') ? $query->paginate() : $query->get();

        if ($request->has('paginate') && $request->input('paginate') == 1) {
            $favorites_data = FavoriteResource::collection($favorites)->response()->getData();
        } else {
            $favorites_data = FavoriteResource::collection($favorites);
        }

        return $this->returnData('data', $favorites_data, 'My Order favorites retrieved successfully');
    }


    // Add a favorite
    public function favorite(FavoriteRequest $request)
    {
        $user = $request->user();

        if ($request->favoritable_type == 'Order') {
            $favoriteType = "App\\Models\\Order";
        } else {
            $favoriteType = "App\\Models\\Ad";
        }

        $alreadyFavorited = Favorite::where('user_id', $user->id)
            ->where('favoritable_id', $request->favoritable_id)
            ->where('favoritable_type', $favoriteType)
            ->exists();

        if ($alreadyFavorited) {
            return $this->returnError('422', 'Already Saved');
        }

        // Create the favorite
        $favorite = Favorite::create([
            'user_id' => $user->id,
            'favoritable_id' => $request->favoritable_id,
            'favoritable_type' => $favoriteType,
        ]);

        return $this->returnSuccessMassage('Saved successfully');
    }

    // Remove a favorite
    public function unfavorite(Request $request, $ad)
    {
        Favorite::where('user_id', auth()->user()->id)->where('favoritable_id', $ad)->delete();

        return $this->returnSuccessMessage('Delete successfully.');
    }
}
