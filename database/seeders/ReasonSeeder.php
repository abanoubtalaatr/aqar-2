<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reasons = [
            [
                'title_ar' => 'السعر غير صحيح',
                'title_en' => 'The price is incorrect',
            ],
            [
                'title_ar' => 'الموقع غير صحيح',
                'title_en' => 'The location is incorrect',
            ],
            [
                'title_ar' => 'العقار غير صحيح',
                'title_en' => 'The property is incorrect',
            ],
            [
                'title_ar' => 'العقار مخالف للهيئة للعقار',
                'title_en' => 'The property is in violation of the real estate authority',
            ]
        ];

        foreach ($reasons as $reason) {
            \App\Models\Reason::create($reason);
        }
    }
}
