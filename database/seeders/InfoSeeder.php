<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $app_info = Info::query()->create(
            [
                'name_ar' => 'جرس',
                'name_en' => 'Garas',
                'logo' => '',
                'logo_footer' => '',
                // 'fav_icon' => '',
                'slogan_ar' => '',
                'slogan_en' => '',
                'bank_account_num' => '',
                'bank_iban_num' => '',
                'bank_qr_image' => '',
                'phone' => fake()->phoneNumber(),
                'whatsapp_phone' => fake()->phoneNumber(),
                // 'faceboob' => '',
                'email' => '',
                // 'twitter' => '',
                // 'instagram' => '',
                'google_play' => '',
                'apple_store' => '',
                'copy_right_ar' => '',
                'copy_right_en' => '',
                'commision_buy' => '',
                'commision_rent' => '',
                'honisty_ar' => '',
                'honisty_en' => '',
                'ad_conditions_ar' => '',
                'ad_conditions_en' => '',
            ]
        );
    }
}
