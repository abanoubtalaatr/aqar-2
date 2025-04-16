<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::query()->create(
            [
                'name_ar' => 'المملكة العربية السعودية',
                'name_en' => 'saudi arabia',
            ]
        );
    }
}
