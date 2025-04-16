<?php

namespace Database\Seeders;

use App\Models\RandomMessage;
use Illuminate\Database\Seeder;

class RandomMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'name_ar' => 'تحديد الميزانية، استشر أهل الخبرة، الحصول على موافقة مسبقة للقرض العقاري، التفاوض والمعاينة، قراءة العقد بعناية.',
                'name_en' => 'Determine the budget, consult experienced people, obtain pre-approval for the mortgage, negotiate and inspect, and read the contract carefully.',
            ],
            [
                'name_ar' => 'تحديد الموقع المناسب، قراءة عقد الإيجار بعناية، المسؤولية عن الصيانة، التفاوض والمعاينة، التمتع بحقوق المستأجر.',
                "name_en" => 'Determining the appropriate location, reading the lease contract carefully, responsibility for maintenance, negotiation and inspection, and enjoying the rights of the tenant.',
            ]
        ];

        foreach ($messages as $message) {
            RandomMessage::create($message);
        }
    }
}
