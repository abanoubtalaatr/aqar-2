<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
              'name_ar' => 'الخدمات الهندسية والمساحية',
              'name_en' => 'Engineering and spatial services',
              'type' => 'engineering',
            ],
            [
                'name_ar' => 'تحديث الصكوك',
                'name_en' => 'Renovations',
                'type' => 'engineering',
              ],
              [
                'name_ar' => 'رفع مساحي',
                'name_en' => 'Surveying',
                'type' => 'engineering',
              ],
              [
                'name_ar' => 'فرز وحدات سكنية',
                'name_en' => 'Sorting residential units',
                'type' => 'engineering',
              ],
              [
                'name_ar' => 'التقارير المساحية',
                'name_en' => 'Survey reports',
                'type' => 'engineering',
              ],
              [
                'name_ar' => 'خدمات التشطيب',
                'name_en' => 'Decoration services',
                'type' => 'decoration',
              ],
              [
                'name_ar' => 'التصميمات الداخلية والخارجية',
                'name_en' => 'Interior and exterior designs',
                'type' => 'decoration',
              ],
              [
                'name_ar' => 'خدمات الديكور',
                'name_en' => 'Decoration services',
                'type' => 'decoration',
              ],
              [
                'name_ar' => 'خدمات تصميم الحدائق',
                'name_en' => 'Design services',
                'type' => 'decoration',
              ],
              [
                'name_ar' => 'بناء عظم ',
                'name_en' => 'Construction',
                'type' => 'construction',
              ],
              [
                'name_ar' => 'عظم بالمواد ',
                'name_en' => 'Construction with materials',
                'type' => 'construction',
              ],
              [
                'name_ar' => 'تسليم علي المفتاح ',
                'name_en' => 'Delivery to the key',
                'type' => 'construction',
              ],
              [
                'name_ar' => 'ترميم',
                'name_en' => 'Painting',
                'type' => 'construction',
              ],
        ];

        foreach ($services as $service) {
            \App\Models\ServiceType::create($service);
        }
    }
}
