<?php

namespace Database\Seeders;

use App\Models\FAQ;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'key' => 'usage_questions',
                'question_ar' => "اسئلة الاستخدام",
                'question_en' => 'Usage questions',
                'answer_ar' => "ماهي متطلبات وشروط نشر واضافة الإعلان العقاري؟",
                'answer_en' => "What are the requirements and conditions for posting and adding real estate ads?",
                'type_ar' => "اسئلة الاستخدام",
                'type_en' => "Usage questions",
            ],
            [
                'key' => 'commission_questions',
                'question_ar' => "اسئلة العمولة",
                'question_en' => 'Question commission',
                'answer_ar' => "اسئلة العمولة؟",
                'answer_en' => "Question commission",
                'type_ar' => "اسئلة العموله",
                'type_en' => "commission questions",
            ],
            [
                'key' => 'general_questions',
                'question_ar' => "اسئلة عامه",
                'question_en' => 'Question general',
                'answer_ar' => "اسئلة عامه",
                'answer_en' => "Question general",
                'type_ar' => "اسئلة عامه",
                'type_en' => "general questions",
            ],
        ];

        foreach ($faqs as $faq) {
            FAQ::create($faq);
        }

    }
}
