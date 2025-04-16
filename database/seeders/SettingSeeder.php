<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'website_name',
                'value' => 'https://aqarsoq.fudex-tech.net/',
                'group' => 'general',
                'sort' => 1,
                'type' => 'text',
            ],
            [
                'key' => 'email',
                'value' => 'admin@admin.com',
                'group' => 'general',
                'sort' => 2,
                'type' => 'text',
            ],
            [
                'key' => 'mobile',
                'value' => '9665557557',
                'group' => 'general',
                'sort' => 2,
                'type' => 'text',
            ],
            [
                'key' => 'iso_version',
                'value' => '1.0.0',
                'group' => 'general',
                'sort' => 3,
                'type' => 'text',
            ],
            [
                'key' => 'android_version',
                'value' => '1.0.0',
                'group' => 'general',
                'sort' => 4,
                'type' => 'text',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']], // Search by key
                $setting                      // Update/Create with this data
            );
        }
    }
}
