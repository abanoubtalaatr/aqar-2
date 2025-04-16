<?php

namespace Database\Seeders;

use App\Models\FaceBuilding;
use Illuminate\Database\Seeder; // Make sure to import the FaceBuilding model

class FaceBuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faces = [
            [
                'name_ar' => 'شمال',
                'name_en' => 'North',
            ],
            [
                'name_ar' => 'شرق',
                'name_en' => 'East',
            ],
            [
                'name_ar' => 'جنوب',
                'name_en' => 'South',
            ],
            [
                'name_ar' => 'غرب',
                'name_en' => 'West',
            ],
            [
                'name_ar' => 'شمال شرق',
                'name_en' => 'Northeast',
            ],
            [
                'name_ar' => 'شرق جنوب',
                'name_en' => 'Southeast',
            ],
            [
                'name_ar' => 'جنوب غرب',
                'name_en' => 'Southwest',
            ],
            [
                'name_ar' => 'شمال غرب',
                'name_en' => 'Northwest',
            ],
            [
                'name_ar' => 'شمال جنوب',
                'name_en' => 'North-South',
            ],
            [
                'name_ar' => 'شرق غرب ',
                'name_en' => 'East-West',
            ],
            [
                'name_ar' => '٣ شوارع',
                'name_en' => '3 Streets',
            ],
            [
                'name_ar' => '٤ شوارع',
                'name_en' => '4 Streets',
            ],
        ];

        foreach ($faces as $face) {
            FaceBuilding::create($face);
        }
    }
}
