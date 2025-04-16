<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqType;
use Illuminate\Http\Request;

class FAQTypeController extends Controller
{
    public function index(Request $request)
    {
        $faqs = FaqType::query();

        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $faqs->where('name_ar', 'LIKE', "%{$keyword}%")
                ->orWhere('name_en', 'LIKE', "%{$keyword}%");
        }

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $faqs = $faqs->paginate($perPage);

        return view('admin.faq-types.index', compact('faqs'));
    }


    public function create()
    {
        return view('admin.faq-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255|unique:faq_types,name_ar',
            'name_en' => 'required|string|max:255|unique:faq_types,name_en',
        ]);

        FaqType::create($request->all());

        return redirect()->route('admin.faq-types.index')
            ->with('success', __('dashboard.FAQs type created successfully.'));
    }

    public function update(Request $request, FaqType $faq_type)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255|unique:faq_types,name_ar,' . $faq_type->id,
            'name_en' => 'required|string|max:255|unique:faq_types,name_en,' . $faq_type->id,
        ]);

        $faq_type->update($request->all());

        return redirect()->route('admin.faq-types.index')
            ->with('success', __('dashboard.FAQs type updated successfully.'));
    }

    public function edit(FaqType $faq_type)
    {
        return view('admin.faq-types.edit', compact('faq_type'));
    }


    public function destroy(FaqType $faq_type)
    {
        $faq_type->delete();
        return 1;
    }
}
