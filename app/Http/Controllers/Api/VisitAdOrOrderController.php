<?php

namespace App\Http\Controllers\Api;

use App\Models\UserVisit;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VisitAdOrOrderRequest;
use App\Traits\GeneralTrait;

class VisitAdOrOrderController extends Controller
{
    use GeneralTrait;

    public function __invoke(VisitAdOrOrderRequest $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
            UserVisit::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'visitable_id' => $request->visitable_id,
                    'visitable_type' => $request->visitable_type,
                ],
                ['last_visited_at' => now()]
            );
        }
        return $this->returnSuccessMessage(__('mobile.saved successfully.'));
    }
}
