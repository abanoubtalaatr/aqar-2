<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RatingRequest;
use App\Traits\GeneralTrait;

class RatingController extends Controller
{
    use GeneralTrait;

    public function getUserRating(User $user)
    {
        $ratings = $user->ratings()->with('user:id,name')->get();

        return $this->returnData('data', $ratings);
    }

    public function store($rateableType, $rateableId, RatingRequest $request)
    {

        $rateableModel = $this->getModel($rateableType);
        $rateable = $rateableModel::findOrFail($rateableId);

        // Check if the user has already rated this entity
        $existingRating = $rateable->ratings()->where('user_id', auth()->id())->first();

        if ($existingRating) {
            return $this->returnError(400, __("mobile.You have already rated this item."));
        }

        // Create a new rating
        $rateable->ratings()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
        ]);

        return $this->returnSuccessMessage(__("mobile.Rating added successfully"));
    }


    public function update($rateableType, $rateableId, Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rateableModel = $this->getModel($rateableType);
        $rateable = $rateableModel::findOrFail($rateableId);

        $rating = $rateable->ratings()->where('user_id', auth()->id())->firstOrFail();
        $rating->update(['rating' => $request->rating]);

        return $this->returnSuccessMessage(__("mobile.Rating updated successfully"));
    }

    public function showAverage($rateableType, $rateableId)
    {
        $rateableModel = $this->getModel($rateableType);
        $rateable = $rateableModel::findOrFail($rateableId);

        $averageRating = $rateable->averageRating();

        return $this->returnData('data', $averageRating);
    }

    private function getModel($rateableType)
    {
        $models = [
            'user' => User::class,
            'ad' => Ad::class,
        ];

        return $models[$rateableType] ?? abort(404, 'Model not found');
    }

    public function getRatingsCount($rateableType, $rateableId)
    {
        $rateableModel = $this->getModel($rateableType);
        $rateable = $rateableModel::findOrFail($rateableId);

        $ratingsCount = $rateable->ratings()->count();

        return $this->returnData('data', $ratingsCount);
    }
}
