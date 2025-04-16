<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\FaqType;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index(Request $request)
    {
        $query = FAQ::query();

        // Search by question or answer (Arabic & English)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('question_ar', 'LIKE', "%$search%")
                  ->orWhere('question_en', 'LIKE', "%$search%")
                  ->orWhere('answer_ar', 'LIKE', "%$search%")
                  ->orWhere('answer_en', 'LIKE', "%$search%");
            });
        }

        if ($request->filled('faq_type_id')) {
            $query->where('faq_type_id', $request->input('faq_type_id'));
        }

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $faqs = $query->latest()->paginate($perPage);

        $faqTypes = FaqType::all();

        return view('admin.faqs.index', compact('faqs', 'faqTypes'));
    }


    public function create()
    {
        $faqTypes = FaqType::where('is_active', 1)->get();
        return view('admin.faqs.create', compact('faqTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_ar' => 'required|string|max:255',
            'question_en' => 'required|string|max:255',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
            'faq_type_id' => 'required|exists:faq_types,id'
        ]);

        FAQ::create($request->all());

        return redirect()->route('admin.faqs.index')
            ->with('success', __('dashboard.FAQ created successfully.'));
    }

    public function update(Request $request, FAQ $faq)
    {
        $request->validate([
            'question_ar' => 'required|string|max:255',
            'question_en' => 'required|string|max:255',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
            'faq_type_id' => 'required|exists:faq_types,id'
        ]);

        $faq->update($request->all());

        return redirect()->route('admin.faqs.index')
            ->with('success', __('dashboard.FAQ updated successfully.'));
    }

    public function edit(FAQ $faq)
    {
        $faqTypes = FaqType::where('is_active', 1)->get();
        return view('admin.faqs.edit', compact('faq', 'faqTypes'));
    }


    public function destroy(FAQ $faq)
    {
        $faq->delete();

        return 1;
    }
}
