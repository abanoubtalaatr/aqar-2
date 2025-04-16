<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Choice;
use App\Models\Key;
use Illuminate\Database\Seeder;

class CategoryKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //-------------------------------------------Apartment-----------------------------------
        $category = Category::where('key', 'apartment')->first();

        $select_key = ['category_id' => $category->id, 'name_ar' => 'عوائل او عزاب', 'name_en' => 'families or singles',  'attribute_name' => 'families_or_singles', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل', 'value_en' => 'families'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عزاب', 'value_en' => 'singles'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل او عزاب', 'value_en' => 'families or singles'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }

        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'range', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الغرف', 'name_en' => 'number of rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الصالات', 'name_en' => 'number of living rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد دورات المياه', 'name_en' => 'number of bathrooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الدور', 'name_en' => 'floor number', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],

            ['category_id' => $category->id, 'name_ar' => 'مؤثثة', 'name_en' => 'Furnished', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مطبخ', 'name_en' => 'kitchen', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'ملحق', 'name_en' => 'Attachment', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل للسيارة', 'name_en' => 'Car Entrance', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مصعد', 'name_en' => 'elevator', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مكيف', 'name_en' => 'air conditioner', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'Sewerage supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'سطح خاص', 'name_en' => 'private roof', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'في فيلا', 'name_en' => 'in villa', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخلين', 'name_en' => 'two entrance', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل خاص', 'name_en' => 'private entrance', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));

            Key::query()->create($key);
        }

        //---------------------------------------End Apartment--------------------------------------

        //---------------------------------------Land-----------------------------------------------

        $category = Category::where('key', 'land')->first();

        $select_key = ['category_id' => $category->id, 'name_ar' => ' الواجهه', 'name_en' => 'interface', 'attribute_name' => 'interface', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال', 'value_en' => 'north'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب', 'value_en' => 'south'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الغرب', 'value_en' => 'east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشرق', 'value_en' => 'west'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب الغربي', 'value_en' => 'south_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال الغربي', 'value_en' => 'north_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => '3 شوارع', 'value_en' => '3_streets'],
            ['key_id' => $select_key_query->id, 'value_ar' => '4 شوارع', 'value_en' => '4_streets'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }

        $select_key = ['category_id' => $category->id, 'name_ar' => 'الغرض', 'name_en' => 'purpose', 'attribute_name' => 'purpose', 'type' => 'select', 'is_required' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'سكني', 'value_en' => 'housing'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'تجاري', 'value_en' => 'commercial'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'سكني و تجاري', 'value_en' => 'housing and commercial'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }

        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'range', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'sewerage supply', 'type' => 'checkbox', 'is_required' => 1],
        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));

            Key::query()->create($key);
        }
        //-----------------------------------End Land---------------------------------------------

        //-----------------------------------Villa------------------------------------------------

        $category = Category::where('key', 'villa')->first();

        $select_key = ['category_id' => $category->id, 'name_ar' => ' الواجهه', 'name_en' => 'interface', 'attribute_name' => 'interface', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال', 'value_en' => 'north'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب', 'value_en' => 'south'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الغرب', 'value_en' => 'east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشرق', 'value_en' => 'west'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب الغربي', 'value_en' => 'south_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال الغربي', 'value_en' => 'north_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => '3 شوارع', 'value_en' => '3_streets'],
            ['key_id' => $select_key_query->id, 'value_ar' => '4 شوارع', 'value_en' => '4_streets'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }

        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' قبو', 'name_en' => 'basement', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مكيف', 'name_en' => 'air conditioner', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الغرف', 'name_en' => 'number of rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الشقق', 'name_en' => 'number of apartments', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الصالات', 'name_en' => 'number of living rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد دورات المياه', 'name_en' => 'number of bathrooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'درج صالة', 'name_en' => 'living room stairs', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'غرفة سائق', 'name_en' => 'driver room', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' غرفة خادمة', 'name_en' => 'maid room', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مسبح', 'name_en' => 'swimming pool', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مؤثثة', 'name_en' => 'furnished', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'بيت شعر', 'name_en' => 'verse', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'حوش', 'name_en' => 'playground', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مطبخ', 'name_en' => 'kitchen', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'ملحق', 'name_en' => 'attachment', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل للسيارة', 'name_en' => 'car entrance', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مصعد', 'name_en' => 'elevator', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'دوبلكس', 'name_en' => 'duplex', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'sewerage supply', 'type' => 'checkbox', 'is_required' => 1],
        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        //-----------------------------------------------End Villa-------------------------------------

        //-----------------------------------------------Floor------------------------------------------

        $category = Category::where('key', 'floor')->first();
        $keys = [

            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الغرف', 'name_en' => 'number of rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الصالات', 'name_en' => 'number of living rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الدور', 'name_en' => 'floor number', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد دورات المياه', 'name_en' => 'number of bathrooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],

            ['category_id' => $category->id, 'name_ar' => 'مؤثثة', 'name_en' => 'Furnished', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل للسيارة', 'name_en' => 'Car Entrance', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مصعد', 'name_en' => 'elevator', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مكيف', 'name_en' => 'air conditioner', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'Sewerage supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'في فيلا', 'name_en' => 'in villa', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخلين', 'name_en' => 'two entrance', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل خاص', 'name_en' => 'private entrance', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],

        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        //-------------------------------------------End Floor -----------------------------------

        //--------------------------------------------Building-------------------------------------
        $category = Category::where('key', 'building')->first();

        $select_key = ['category_id' => $category->id, 'name_ar' => 'الغرض', 'name_en' => 'purpose', 'attribute_name' => 'purpose', 'type' => 'select', 'is_required' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'سكني', 'value_en' => 'housing'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'تجاري', 'value_en' => 'commercial'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'سكني و تجاري', 'value_en' => 'housing and commercial'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }

        $select_key = ['category_id' => $category->id, 'name_ar' => ' الواجهه', 'name_en' => 'interface', 'attribute_name' => 'interface', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال', 'value_en' => 'north'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب', 'value_en' => 'south'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الغرب', 'value_en' => 'east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشرق', 'value_en' => 'west'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب الغربي', 'value_en' => 'south_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال الغربي', 'value_en' => 'north_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => '3 شوارع', 'value_en' => '3_streets'],
            ['key_id' => $select_key_query->id, 'value_ar' => '4 شوارع', 'value_en' => '4_streets'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد المحلات', 'name_en' => 'number of shops', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الغرف', 'name_en' => 'number of rooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الشقق', 'name_en' => 'number of apartment', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مؤثثة', 'name_en' => 'Furnished', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => ' قبو', 'name_en' => 'basement', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'Sewerage supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل خاص', 'name_en' => 'private entrance', 'type' => 'checkbox', 'is_required' => 1],

        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        $category = Category::where('key', 'shop')->first();
        $select_key = ['category_id' => $category->id, 'name_ar' => ' الواجهه', 'name_en' => 'interface', 'attribute_name' => 'interface', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال', 'value_en' => 'north'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب', 'value_en' => 'south'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الغرب', 'value_en' => 'east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشرق', 'value_en' => 'west'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب الغربي', 'value_en' => 'south_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال الغربي', 'value_en' => 'north_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => '3 شوارع', 'value_en' => '3_streets'],
            ['key_id' => $select_key_query->id, 'value_ar' => '4 شوارع', 'value_en' => '4_streets'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1],

            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'Sewerage supply', 'type' => 'checkbox', 'is_required' => 1],

        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        //--------------------------------------End Building---------------------------------

        //--------------------------------------House----------------------------------------
        $category = Category::where('key', 'house')->first();
        $select_key = ['category_id' => $category->id, 'name_ar' => ' الواجهه', 'name_en' => 'interface', 'attribute_name' => 'interface', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال', 'value_en' => 'north'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب', 'value_en' => 'south'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الغرب', 'value_en' => 'east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشرق', 'value_en' => 'west'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب الغربي', 'value_en' => 'south_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال الغربي', 'value_en' => 'north_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => '3 شوارع', 'value_en' => '3_streets'],
            ['key_id' => $select_key_query->id, 'value_ar' => '4 شوارع', 'value_en' => '4_streets'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $keys = [

            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'range', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الغرف', 'name_en' => 'number of rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الصالات', 'name_en' => 'number of living rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد دورات المياه', 'name_en' => 'number of bathrooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => ' عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],

            ['category_id' => $category->id, 'name_ar' => 'مؤثثة', 'name_en' => 'Furnished', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مطبخ', 'name_en' => 'kitchen', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'ملحق', 'name_en' => 'Attachment', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل للسيارة', 'name_en' => 'Car Entrance', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'sewerage supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'غرفة سائق', 'name_en' => 'driver room', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => ' غرفة خادمة', 'name_en' => 'maid room', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'بيت شعر', 'name_en' => 'verse', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'حوش', 'name_en' => 'playground', 'type' => 'checkbox', 'is_required' => 1],
        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        //-------------------------------------------End House--------------------------------------

        //-------------------------------------------Rest-------------------------------------------
        $category = Category::where('key', 'rest')->first();
        $select_key = ['category_id' => $category->id, 'name_ar' => ' الواجهه', 'name_en' => 'interface', 'attribute_name' => 'interface', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال', 'value_en' => 'north'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب', 'value_en' => 'south'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الغرب', 'value_en' => 'east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشرق', 'value_en' => 'west'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب الغربي', 'value_en' => 'south_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال الغربي', 'value_en' => 'north_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => '3 شوارع', 'value_en' => '3_streets'],
            ['key_id' => $select_key_query->id, 'value_ar' => '4 شوارع', 'value_en' => '4_streets'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $select_key = ['category_id' => $category->id, 'name_ar' => 'عوائل او عزاب', 'name_en' => 'families or singles',  'attribute_name' => 'families_or_singles', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل', 'value_en' => 'families'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عزاب', 'value_en' => 'singles'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل او عزاب', 'value_en' => 'families or singles'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'range', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الغرف', 'name_en' => 'number of rooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الصالات', 'name_en' => 'number of living rooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد دورات المياه', 'name_en' => 'number of bathrooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => ' عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],

            ['category_id' => $category->id, 'name_ar' => ' مسبح', 'name_en' => 'pool', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'ملعب كره قدم', 'name_en' => 'football field', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'ملعب كره طائره', 'name_en' => 'volleyball field', 'type' => 'checkbox', 'is_required' => 1],

            ['category_id' => $category->id, 'name_ar' => ' بيت شعر', 'name_en' => 'verse', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => ' ملاهي', 'name_en' => 'Amusement park games', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => ' قسم عوائل', 'name_en' => 'family area', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل للسيارة', 'name_en' => 'car entrance', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مطبخ', 'name_en' => 'kitchen', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],

            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'sewerage supply', 'type' => 'checkbox', 'is_required' => 1],
        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        //--------------------------------------Farm------------------------------------
        $category = Category::where('key', 'farm')->first();

        $select_key = ['category_id' => $category->id, 'name_ar' => ' الواجهه', 'name_en' => 'interface', 'attribute_name' => 'interface', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال', 'value_en' => 'north'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب', 'value_en' => 'south'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الغرب', 'value_en' => 'east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشرق', 'value_en' => 'west'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب الغربي', 'value_en' => 'south_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال الغربي', 'value_en' => 'north_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => '3 شوارع', 'value_en' => '3_streets'],
            ['key_id' => $select_key_query->id, 'value_ar' => '4 شوارع', 'value_en' => '4_streets'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }

        $select_key = ['category_id' => $category->id, 'name_ar' => 'عوائل او عزاب', 'name_en' => 'families or singles',  'attribute_name' => 'families_or_singles', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل', 'value_en' => 'families'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عزاب', 'value_en' => 'singles'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل او عزاب', 'value_en' => 'families or singles'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'range', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الآبار', 'name_en' => 'number of wells', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الاشجار', 'name_en' => 'number of trees', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => ' بيت شعر', 'name_en' => 'verse', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'sewerage supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الغرف', 'name_en' => 'number of rooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الصالات', 'name_en' => 'number of living rooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد دورات المياه', 'name_en' => 'number of bathrooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مطبخ', 'name_en' => 'kitchen', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' ملاهي', 'name_en' => 'Amusement park games', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل للسيارة', 'name_en' => 'car entrance', 'type' => 'checkbox', 'is_required' => 1],

            ['category_id' => $category->id, 'name_ar' => ' مسبح', 'name_en' => 'pool', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'ملعب كره قدم', 'name_en' => 'football field', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'ملعب كره طائره', 'name_en' => 'volleyball field', 'type' => 'checkbox', 'is_required' => 1],

        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        //-----------------------------------------End Farm------------------------------------------

        //-----------------------------------------Commercial Office------------------------------------------
        $category = Category::where('key', 'commercial_office')->first();
        $select_key = ['category_id' => $category->id, 'name_ar' => ' الواجهه', 'name_en' => 'interface', 'attribute_name' => 'interface', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال', 'value_en' => 'north'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب', 'value_en' => 'south'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الغرب', 'value_en' => 'east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشرق', 'value_en' => 'west'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب الغربي', 'value_en' => 'south_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال الغربي', 'value_en' => 'north_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => '3 شوارع', 'value_en' => '3_streets'],
            ['key_id' => $select_key_query->id, 'value_ar' => '4 شوارع', 'value_en' => '4_streets'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $keys = [

            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'range', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مؤثثة', 'name_en' => 'Furnished', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'sewerage supply', 'type' => 'checkbox', 'is_required' => 1],

        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }
        //----------------------------------------------End Commercial Office----------------------------------

        //-------------------------------------------WareHouse-------------------------------------------------
        $category = Category::where('key', 'warehouse')->first();
        $select_key = ['category_id' => $category->id, 'name_ar' => ' الواجهه', 'name_en' => 'interface', 'attribute_name' => 'interface', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال', 'value_en' => 'north'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب', 'value_en' => 'south'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الغرب', 'value_en' => 'east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشرق', 'value_en' => 'west'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب الغربي', 'value_en' => 'south_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال الغربي', 'value_en' => 'north_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => '3 شوارع', 'value_en' => '3_streets'],
            ['key_id' => $select_key_query->id, 'value_ar' => '4 شوارع', 'value_en' => '4_streets'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }

        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'range', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1],
        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        // --------------------------------------------End WareHouse------------------------------

        // --------------------------------------------Camp---------------------------------------
        $category = Category::where('key', 'camp')->first();
        $keys = [

            ['category_id' => $category->id, 'name_ar' => 'قسم عوائل', 'name_en' => 'family area', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'sewerage supply', 'type' => 'checkbox', 'is_required' => 1],

        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        // --------------------------------------------End Camp---------------------------------------

        // --------------------------------------------Room ---------------------------------------

        $category = Category::where('key', 'room')->first();
        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'range', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1],

            ['category_id' => $category->id, 'name_ar' => 'مؤثثة', 'name_en' => 'Furnished', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مطبخ', 'name_en' => 'kitchen', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'sewerage supply', 'type' => 'checkbox', 'is_required' => 1],

        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }
        // --------------------------------------------End Room ---------------------------------------

        // --------------------------------------------Furnished Apartment ----------------------------

        $category = Category::where('key', 'furnished_apartment')->first();
        $select_key = ['category_id' => $category->id, 'name_ar' => 'عوائل او عزاب', 'name_en' => 'families or singles',  'attribute_name' => 'families_or_singles', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل', 'value_en' => 'families'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عزاب', 'value_en' => 'singles'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل او عزاب', 'value_en' => 'families or singles'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'range', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الغرف', 'name_en' => 'number of rooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الصالات', 'name_en' => 'number of living rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الدور', 'name_en' => 'floor number', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'ملحق', 'name_en' => 'Attachment', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل للسيارة', 'name_en' => 'Car Entrance', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مكيف', 'name_en' => 'air conditioner', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مؤثثة', 'name_en' => 'furnished', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مطبخ', 'name_en' => 'kitchen', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مصعد', 'name_en' => 'elevator', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'سطح خاص', 'name_en' => 'private roof', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'في فيلا', 'name_en' => 'in villa', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخلين', 'name_en' => 'two entrance', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل خاص', 'name_en' => 'private entrance', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],

            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'sewerage supply', 'type' => 'checkbox', 'is_required' => 1],

        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        // -------------------------------------------End Furnished Apartment ----------------------------

        // -------------------------------------------Chalet ---------------------------------------------

        $category = Category::where('key', 'chalet')->first();
        $select_key = ['category_id' => $category->id, 'name_ar' => 'عوائل او عزاب', 'name_en' => 'families or singles',  'attribute_name' => 'families_or_singles', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل', 'value_en' => 'families'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عزاب', 'value_en' => 'singles'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل او عزاب', 'value_en' => 'families or singles'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'range', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الغرف', 'name_en' => 'number of rooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الصالات', 'name_en' => 'number of living rooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد دورات المياه', 'name_en' => 'number of bathrooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => ' عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مطبخ', 'name_en' => 'kitchen', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل للسيارة', 'name_en' => 'car entrance', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => ' مسبح', 'name_en' => 'pool', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'ملعب كره قدم', 'name_en' => 'football field', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'ملعب كره طائره', 'name_en' => 'volleyball field', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' بيت شعر', 'name_en' => 'verse', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => ' ملاهي', 'name_en' => 'Amusement park games', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' قسم عوائل', 'name_en' => 'family area', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'sewerage supply', 'type' => 'checkbox', 'is_required' => 1],

        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }
        // --------------------------------------End Chalet ----------------------------------------

        // -------------------------------------- Furnished Villa ----------------------------------

        $category = Category::where('key', 'furnished_villa')->first();
        $select_key = ['category_id' => $category->id, 'name_ar' => ' الواجهه', 'name_en' => 'interface', 'attribute_name' => 'interface', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال', 'value_en' => 'north'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب', 'value_en' => 'south'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الغرب', 'value_en' => 'east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشرق', 'value_en' => 'west'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الجنوب الغربي', 'value_en' => 'south_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'الشمال الغربي', 'value_en' => 'north_east'],
            ['key_id' => $select_key_query->id, 'value_ar' => '3 شوارع', 'value_en' => '3_streets'],
            ['key_id' => $select_key_query->id, 'value_ar' => '4 شوارع', 'value_en' => '4_streets'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $select_key = ['category_id' => $category->id, 'name_ar' => 'عوائل او عزاب', 'name_en' => 'families or singles',  'attribute_name' => 'families_or_singles', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل', 'value_en' => 'families'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عزاب', 'value_en' => 'singles'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل او عزاب', 'value_en' => 'families or singles'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الغرف', 'name_en' => 'number of rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الصالات', 'name_en' => 'number of living rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد دورات المياه', 'name_en' => 'number of bathrooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'درج صالة', 'name_en' => 'living room stairs', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'غرفة سائق', 'name_en' => 'driver room', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' غرفة خادمة', 'name_en' => 'maid room', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مسبح', 'name_en' => 'swimming pool', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مؤثثة', 'name_en' => 'furnished', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'بيت شعر', 'name_en' => 'verse', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'حوش', 'name_en' => 'playground', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مطبخ', 'name_en' => 'kitchen', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'ملحق', 'name_en' => 'attachment', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل للسيارة', 'name_en' => 'car entrance', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مصعد', 'name_en' => 'elevator', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'دوبلكس', 'name_en' => 'duplex', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'sewerage supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => ' قبو', 'name_en' => 'basement', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مكيف', 'name_en' => 'air conditioner', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' ملاهي', 'name_en' => 'Amusement park games', 'type' => 'checkbox', 'is_required' => 1],
        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        // --------------------------------------End Furnished Villa ------------------

        // --------------------------------------Hall ----------------------------------

        $category = Category::where('key', 'hall')->first();
        $select_key = ['category_id' => $category->id, 'name_ar' => 'عوائل او عزاب', 'name_en' => 'families or singles',  'attribute_name' => 'families_or_singles', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل', 'value_en' => 'families'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عزاب', 'value_en' => 'singles'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل او عزاب', 'value_en' => 'families or singles'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $keys = [

            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'range', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الآبار', 'name_en' => 'number of wells', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الاشجار', 'name_en' => 'number of trees', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الصالات', 'name_en' => 'number of living rooms', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'بيت شعر', 'name_en' => 'verse', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مطبخ', 'name_en' => 'kitchen', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل للسيارة', 'name_en' => 'car entrance', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'sewerage supply', 'type' => 'checkbox', 'is_required' => 1],
        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        // -----------------------------------End Hall -------------------------------------------

        // -----------------------------------Studio -------------------------------------------
        $category = Category::where('key', 'studio')->first();
        $select_key = ['category_id' => $category->id, 'name_ar' => 'عوائل او عزاب', 'name_en' => 'families or singles',  'attribute_name' => 'families_or_singles', 'type' => 'select', 'is_required' => 1, 'show_in_order' => 1];
        $select_key_query = Key::query()->create($select_key);
        $choices = [
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل', 'value_en' => 'families'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عزاب', 'value_en' => 'singles'],
            ['key_id' => $select_key_query->id, 'value_ar' => 'عوائل او عزاب', 'value_en' => 'families or singles'],
        ];
        foreach ($choices as $choice) {
            Choice::query()->create($choice);
        }
        $keys = [
            ['category_id' => $category->id, 'name_ar' => 'عرض الشارع', 'name_en' => 'street width', 'type' => 'number_with_select', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد الغرف', 'name_en' => 'number of rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الصالات', 'name_en' => 'number of living rooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'عدد دورات المياه', 'name_en' => 'number of bathrooms', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => ' عمر العقار', 'name_en' => 'property age', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'الدور', 'name_en' => 'floor number', 'type' => 'number_with_select', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مؤثثة', 'name_en' => 'Furnished', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مطبخ', 'name_en' => 'kitchen', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'ملحق', 'name_en' => 'Attachment', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مصعد', 'name_en' => 'elevator', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مكيف', 'name_en' => 'air conditioner', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الماء', 'name_en' => 'water supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الكهرباء', 'name_en' => 'electricity supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'توفر الصرف', 'name_en' => 'Sewerage supply', 'type' => 'checkbox', 'is_required' => 1],
            ['category_id' => $category->id, 'name_ar' => 'سطح خاص', 'name_en' => 'private roof', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'في فيلا', 'name_en' => 'in villa', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخلين', 'name_en' => 'two entrance', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
            ['category_id' => $category->id, 'name_ar' => 'مدخل خاص', 'name_en' => 'private entrance', 'type' => 'checkbox', 'is_required' => 1, 'show_in_order' => 1],
        ];
        foreach ($keys as $key) {
            $key['attribute_name'] = strtolower(str_replace(' ', '_', $key['name_en']));
            Key::query()->create($key);
        }

        //---------------------------------------End Studio-------------------------------------------------
    }
}
