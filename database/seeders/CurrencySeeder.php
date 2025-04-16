<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::query()->create(
            [
                'name_ar' => 'رسال سعودي ',
                'name_en' => 'ryal',
            ]
        );
    }
}
