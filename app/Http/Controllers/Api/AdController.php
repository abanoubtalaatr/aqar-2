<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Filters\AdFilters;
use App\Services\AdService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AdRequest;
use App\Http\Resources\Api\AdResource;
use App\Http\Resources\Api\SimpleAdResource;

class AdController extends Controller
{
    use GeneralTrait;

    protected $adService;

    public function __construct(AdService $adService)
    {
        $this->adService = $adService;
    }

    /**
     * Handles GET requests to retrieve a list of ads.
     *
     * This function applies filters to the query builder, paginates the results,
     * and returns the ads in the appropriate response format.
     *
     * @param Request $request The incoming HTTP request.
     * @return mixed The response containing the ads data.
     */

    public function index(Request $request)
    {
        $query = Ad::query()->where('is_active', 1);

        $filters = new AdFilters($request);
        $query = $filters->apply($query);

        $ads = $request->has('paginate') ? $query->paginate() : $query->get();

        // Get the paginated data from the AdResource collection
        if ($request->has('paginate') && $request->input('paginate') == 1) {
            $ads_data = SimpleAdResource::collection($ads)->response()->getData();
        } else {
            $total_ads = $ads instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator ? $ads->total() : $ads->count();

            $ads_data['data'] = SimpleAdResource::collection($ads);
            $ads_data['total'] = $total_ads;
        }

        return $this->returnData('data', $ads_data);
    }


    /**
     * Handles GET requests to retrieve a specific ad by its ID.
     *
     * @param int $id The ID of the ad to be retrieved.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the ad is not found.
     * @return mixed The response containing the ad data or an error message.
     */
    public function show($id)
    {
        // Fetch the ad with its similar_products relationship

        $ad = Ad::find($id);
        // Check if the ad exists and is active
        if ($ad && $ad->is_active == 1) {
            $ad->increment('views_count');
            // Use a resource to transform the ad data
            $ads_data = new AdResource($ad);

            // Return the transformed ad data
            return $this->returnData('data', $ads_data);
        }

        // Return an error if the ad is not found or inactive
        return $this->returnError('404', __('site.not found.'));
    }

    /**
     * Update an ad.
     *
     * @param AdRequest $request The request object.
     * @param int $id The ID of the ad to update.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     */
    public function update(AdRequest $request, $id): JsonResponse
    {
        $ad = $this->adService->updateAd($request, $id);

        if (!$ad) {
            return $this->returnError('404', __('mobile.not found.'));
        }

        return $this->returnSuccessMassage(__('mobile.Ad updated successfully.'));
    }

    /**
     * Deletes an ad by its ID.
     *
     * @param int $id The ID of the ad to be deleted.
     * @throws \Exception If the ad is not found or if there is an error during deletion.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the success or failure of the deletion operation.
     */
    public function destroy($id)
    {
        $ad = Ad::find($id);
        if ($ad) {

            $ad->delete();
            $ad->adable->delete();

            return $this->returnSuccessMassage(__('mobile.Ad deleted successfully.'));
        } else {
            return $this->returnError('404', __('mobile.not found.'));
        }
    }
}
