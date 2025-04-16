<?php

namespace App\Http\Controllers\Api\RealEstate;

use App\Models\Ad;
use App\Filters\AdFilters;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SimpleAdResource;

class MyRealEstateController extends Controller
{
    use GeneralTrait;


    public function index(Request $request)
    {
        ;
        $query = Ad::query()->where('user_id', auth()->id());

        $filters = new AdFilters($request);

        $query = $filters->apply($query);

        $ads = $request->has('paginate') ? $query->paginate() : $query->get();

        // Get the paginated data from the AdResource collection
        if ($request->has('paginate') && $request->input('paginate') == 1) {
            $ads_data = SimpleAdResource::collection($ads)->response()->getData();
        } else {
            $ads_data = SimpleAdResource::collection($ads);
        }

        return $this->returnData('data', $ads_data);
    }

    public function show(Ad $my_real_estate)
    {
        $this->authorize('show', $my_real_estate);

        return $this->returnData('data', $my_real_estate);
    }

    public function destroy(Ad $my_real_estate)
    {
        $this->authorize('delete', $my_real_estate);

        $my_real_estate->delete();

        return $this->returnSuccessMessage(__('mobile.Ad deleted successfully.'));
    }

    public function myRealEstatesCounts()
    {
        return $this->returnData('data', Ad::where('user_id', auth()->id())->count());
    }
}
