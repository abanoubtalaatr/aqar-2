<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Reason;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ReportAdController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::query()->with('reason')->where('ad_id', '!=', null)->whereNull('order_id');

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $reasons = Reason::all();

        $keyword = $request->input('keyword');

        if ($request->filled('keyword')) {
            $query->whereHas('user', function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%");
            })->orWhere('ad_id', $keyword);
        }
        if ($request->filled('reason')) {
            $query->where('reason_id', $request->input('reason'));
        }

        $reports = $query->latest()->paginate($perPage);


        return view('admin.report-ads.index', compact('reports', 'reasons'));
    }


    public function respond(Request $request, $id)
    {
        $request->validate([
            'response_message' => 'required|string',
        ]);

        $report = Report::findOrFail($id);
        $report->response_message = $request->response_message;
        $report->save();

        // Send email if user has an email
        // if ($contact->user && $contact->user->email) {
        //     Mail::to($contact->user->email)->send(new ContactResponseMail($contact));
        // }

        return redirect()->route('admin.report-ads.index')->with('success', 'dashboard.Response sent successfully, and email notification sent.');
    }

    public function destroy(Report $report_ad)
    {
        $report_ad->delete();
        return 1;
    }
}
