<?php

namespace App\Http\Controllers\Api;

use App\Models\FAQ;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;

class FAQController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $faqs = FAQ::with('faqType')->get(); // Fetch all FAQs

        // Group FAQs by their `key` attribute and structure them
        $groupedFaqs = $faqs->groupBy('faq_type_id')->map(function ($group, $key) {
            return [
                'key' => strtolower(str_replace(' ', '_', $group[0]['title'])),
                'title' => $group[0]['question'],
                'data' => $group->map(function ($faq) {
                    return [
                        'id' => $faq->id,
                        'question' => $faq->question,
                        'answer' => $faq->answer,
                        'type' => $faq?->faqType?->name,
                        'key' => strtolower(str_replace(' ', '_', $faq?->faqType?->title)),
                    ];
                })->toArray()
            ];
        })->values()->toArray(); // Convert to values to get an array

        return response()->json([
            "status" => true,
            "msg" => "",
            "faqs" => $groupedFaqs,
            "is_verify" => true,
        ]);


    }
}
