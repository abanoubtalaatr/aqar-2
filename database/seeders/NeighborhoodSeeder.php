<?php

namespace Database\Seeders;

use App\Models\Neighborhood;
use Illuminate\Database\Seeder;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Neighborhood::query()->create(
            [
                'name_ar' => 'الحي 1',
                'name_en' => 'neighborhood 1',
                'city_id' => 1,
            ]
        );
    }
}
