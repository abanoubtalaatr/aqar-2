<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReportRequest;
use App\Models\Report;
use App\Traits\GeneralTrait;

class ReportController extends Controller
{
    use GeneralTrait;
    public function store(ReportRequest $request)
    {
        $report = Report::create($request->validated());

        return $this->returnData('data', $report, __('mobile.reported_successfully'));
    }
}
