<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [

            ['adable' => 'App\Models\Apartment', 'key' => 'apartment', 'name_ar' => 'شقق', 'name_en' => 'Apartment', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000'],
            ['adable' => 'App\Models\Land', 'key' => 'land', 'name_ar' => 'أرض', 'name_en' => 'Land', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000'],
            ['adable' => 'App\Models\Villa', 'key' => 'villa', 'name_ar' => 'فلل', 'name_en' => 'villas', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000'],
            ['adable' => 'App\Models\Floor', 'key' => 'floor', 'name_ar' => 'دور', 'name_en' => 'Floor', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000'],
            ['adable' => 'App\Models\Building', 'key' => 'building', 'name_ar' => 'عمارة', 'name_en' => 'buildings', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000'],
            ['adable' => 'App\Models\Shop', 'key' => 'shop', 'name_ar' => 'محلات', 'name_en' => 'Shops', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000'],
            ['adable' => 'App\Models\House', 'key' => 'house', 'name_ar' => 'بيت', 'name_en' => 'House', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000'],
            ['adable' => 'App\Models\Farm', 'key' => 'farm', 'name_ar' => 'مزارع', 'name_en' => 'Farms', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000'],
            ['adable' => 'App\Models\Rest', 'key' => 'rest', 'name_ar' => 'إستراحات', 'name_en' => 'Rests', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000'],
            ['adable' => 'App\Models\CommercialOffice', 'key' => 'commercial_office', 'name_ar' => ' مكاتب تجارية', 'name_en' => 'Commercial Offices', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000'],
            ['adable' => 'App\Models\Warehouse', 'key' => 'warehouse', 'name_ar' => 'مستودعات', 'name_en' => 'Warehouse', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000 '],
            ['adable' => 'App\Models\Camp', 'key' => 'camp', 'name_ar' => 'مخيمات', 'name_en' => 'Camps', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000'],
            ['adable' => 'App\Models\Room', 'key' => 'room', 'name_ar' => 'غرف', 'name_en' => 'Rooms', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000   '],
            ['adable' => 'App\Models\Studio', 'key' => 'studio', 'name_ar' => 'استوديو', 'name_en' => 'Studios', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000   '],
            ['adable' => 'App\Models\Chalet', 'key' => 'chalet', 'name_ar' => 'شاليهات', 'name_en' => 'Chalets', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000   '],
            ['adable' => 'App\Models\FurnishedApartment', 'key' => 'furnished_apartment', 'name_ar' => ' شقق مفروشة ', 'name_en' => 'Furnished Apartment', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000 '],
            ['adable' => 'App\Models\FurnishedVilla', 'key' => 'furnished_villa', 'name_ar' => ' فلل مفروشة', 'name_en' => 'Furnished Villas', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000 '],
            ['adable' => 'App\Models\Hall', 'key' => 'hall', 'name_ar' => 'قاعات', 'name_en' => 'Hall', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000  '],
            // ['key' => 'exhibition', 'name_ar' => 'معارض', 'name_en' => 'Exhibitions', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000 ' , ],
            // ['key' => 'factorie', 'name_ar' => 'مصانع', 'name_en' => 'Factories', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000 ' , ],
            // ['key' => 'shopping_center', 'name_ar' => 'مركز تجاري', 'name_en' => 'Shopping Center', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000   ' , ],
            // ['key' => 'tower', 'name_ar' => 'أبراج', 'name_en' => 'Towers', 'max_rent_price' => '10000', 'min_rent_price' => '1000', 'max_sell_price' => '1000000', 'min_sell_price' => '100000   ' , ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
