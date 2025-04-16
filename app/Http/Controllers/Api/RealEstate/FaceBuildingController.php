<?php

namespace App\Http\Controllers\Api\RealEstate;

use App\Models\FaceBuilding;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\FaceBuildingResource;

class FaceBuildingController extends Controller
{
    use GeneralTrait;

    public function index(Request $request)
    {
        if ($request->has('all') && $request->input('all') == 1) {
            $faceBuildings = FaceBuilding::get();
        } else {
            $firstRow = FaceBuilding::first();

            // Check if there is at least one row in the database
            if ($firstRow) {
                $faceBuildings = FaceBuilding::where('id', '!=', $firstRow->id)->get();
            } else {
                // If no rows are found, return an empty collection
                $faceBuildings = collect([]);
            }
        }

        $faceBuildings = FaceBuildingResource::collection($faceBuildings);

        return $this->returnData('data', $faceBuildings);
    }
}
