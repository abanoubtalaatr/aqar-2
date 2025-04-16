<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name_ar' => 'الاقتراحات',
                'name_en' => 'Suggestions',
                'type' => "help",
            ],
            [
                'name_ar' => 'الحساب والتوثيق',
                'name_en' => 'Account and verification',
                'type' => "help",
            ],
            [
                'name_ar' => 'الاعلانات',
                'name_en' => 'Ads',
                'type' => "help",
            ],
            [
                'name_ar' => 'موضوع اخر',
                'name_en' => 'Another subject',
                'type' => "help",
            ],

            [
                'name_ar' => "الموقع الاكتروني",
                'name_en' => 'The website',
                'type' => "support",
            ],
            [
                'name_ar' => "ايفون",
                'name_en' => 'Ios',
                'type' => "support",
            ],
            [
                'name_ar' => "اندرويد",
                'name_en' => 'Andriod',
                'type' => "support",
            ],
            [
                'name_ar' => "هوواي",
                'name_en' => 'Huwai',
                'type' => "support",
            ],
        ];

        foreach ($types as $type) {
            \App\Models\ContactType::create($type);
        }
    }
}
