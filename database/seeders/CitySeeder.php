<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            [
                'name_ar' => 'عرعر',
                'name_en' => 'Arar',
                'country_id' => 7,
                'latitude' => '30.972151',
                'longitude' => '41.013329',
                'latitude_min' => '30.88',
                'latitude_max' => '31.22',
                'longitude_min' => '41.00',
                'longitude_max' => '41.38',
            ],

            [
                'name_ar' => 'القريات',
                'name_en' => 'Al Qurayyat',
                'country_id' => 7,
                'latitude' => '31.349171',
                'longitude' => '37.326431',

                'latitude_min' => '31.28',
                'latitude_max' => '31.45',
                'longitude_min' => '37.19',
                'longitude_max' => '37.45',
            ],

            [
                'name_ar' => 'الجوف',
                'name_en' => 'Al Jowf',
                'country_id' => 7,
                'latitude' => '29.87132400283949',
                'longitude' => '39.318300308968404',

                'latitude_min' => '29.00',
                'latitude_max' => '31.00',
                'longitude_min' => '37.00',
                'longitude_max' => '39.50',
            ],

            [
                'name_ar' => 'تبوك',
                'name_en' => 'Tabuk',
                'country_id' => 7,
                'latitude' => '28.383509',
                'longitude' => '36.566193',

                'latitude_min' => '27.20',
                'latitude_max' => '28.60',
                'longitude_min' => '35.00',
                'longitude_max' => '37.00',
            ],

            [
                'name_ar' => 'حائل',
                'name_en' => 'Hail',
                'country_id' => 7,
                'latitude' => '27.511410',
                'longitude' => '41.720825',

                'latitude_min' => '25.60',
                'latitude_max' => '28.00',
                'longitude_min' => '39.30',
                'longitude_max' => '42.00',
            ],
            [
                'name_ar' => 'القصيم',
                'name_en' => 'Al Qassim',
                'country_id' => 7,
                'latitude' => '26.549543880399497',
                'longitude' => '43.473467191654926',


                'latitude_min' => '25.00',
                'latitude_max' => '27.00',
                'longitude_min' => '42.00',
                'longitude_max' => '45.50',
            ],
            [
                'name_ar' => 'الرياض',
                'name_en' => 'Riyadh',
                'country_id' => 7,
                'latitude' => '24.723749982386707',
                'longitude' => '46.668434675780276',

                'latitude_min' => '24.50',
                'latitude_max' => '25.50',
                'longitude_min' => '46.50',
                'longitude_max' => '47.50',
            ],

            [
                'name_ar' => 'الخرج',
                'name_en' => 'Al-Kharj',
                'country_id' => 7,
                'latitude' => '24.15775139715752',
                'longitude' => '47.32268450715967',

                'latitude_min' => '24.00',
                'latitude_max' => '25.00',
                'longitude_min' => '47.00',
                'longitude_max' => '48.00',
            ],

            [
                'name_ar' => 'الاحساء',
                'name_en' => 'Al Ahsa',
                'country_id' => 7,
                'latitude' => '22.699150199904167',
                'longitude' => '49.65301606797657',

                'latitude_min' => '25.00',
                'latitude_max' => '26.00',
                'longitude_min' => '48.00',
                'longitude_max' => '49.00',
            ],

            [
                'name_ar' => 'الدمام',
                'name_en' => 'Dammam',
                'country_id' => 7,
                'latitude' => '26.416597199343848',
                'longitude' => '50.09552005236179',

                'latitude_min' => '26.40',
                'latitude_max' => '26.60',
                'longitude_min' => '49.80',
                'longitude_max' => '50.30',
            ],

            [
                'name_ar' => 'حفر الباطن',
                'name_en' => 'Hafar Al Batin',
                'country_id' => 7,
                'latitude' => '28.377089860410578',
                'longitude' => '45.96360422315435',

                'latitude_min' => '27.30',
                'latitude_max' => '27.60',
                'longitude_min' => '46.80',
                'longitude_max' => '47.20',
            ],
            [
                'name_ar' => 'المدينة المنورة',
                'name_en' => 'Madinah',
                'country_id' => 7,
                'latitude' => '24.487231068660005',
                'longitude' => '39.585267607181414',

                'latitude_min' => '24.45',
                'latitude_max' => '24.75',
                'longitude_min' => '39.50',
                'longitude_max' => '40.00',
            ],
            [
                'name_ar' => 'جدة',
                'name_en' => 'Jeddah',
                'country_id' => 7,
                'latitude' => '21.52550198586958',
                'longitude' => '39.194375487759444',

                'latitude_min' => '21.25',
                'latitude_max' => '21.75',
                'longitude_min' => '39.10',
                'longitude_max' => '39.50',
            ],
            [
                'name_ar' => 'الطائف',
                'name_en' => 'Taif',
                'country_id' => 7,
                'latitude' => '21.284239384240337',
                'longitude' => '40.42442434786981',

                'latitude_min' => '20.00',
                'latitude_max' => '21.00',
                'longitude_min' => '40.00',
                'longitude_max' => '41.00',
            ],

            [
                'name_ar' => 'مكة',
                'name_en' => 'Makkah',
                'country_id' => 7,
                'latitude' => '21.42762560107433',
                'longitude' => '39.82455596743534',

                'latitude_min' => '21.30',
                'latitude_max' => '21.50',
                'longitude_min' => '39.70',
                'longitude_max' => '40.10',
            ],
            [
                'name_ar' => 'الباحة',
                'name_en' => 'Al Bahah',
                'country_id' => 7,
                'latitude' => '20.011349663686033',
                'longitude' => '41.46922482264512',

                'latitude_min' => '19.90',
                'latitude_max' => '20.10',
                'longitude_min' => '41.40',
                'longitude_max' => '41.70',
            ],
            [
                'name_ar' => 'عسير',
                'name_en' => 'Aseer',
                'country_id' => 7,
                'latitude' => '19.09134547906751',
                'longitude' => '42.89715054376394',

                'latitude_min' => '18.00',
                'latitude_max' => '19.50',
                'longitude_min' => '41.00',
                'longitude_max' => '42.50',
            ],
            [
                'name_ar' => 'نجران',
                'name_en' => 'Najran',
                'country_id' => 7,
                'latitude' => '17.570252422537077',
                'longitude' => '44.23302584495787',


                'latitude_min' => '17.50',
                'latitude_max' => '19.00',
                'longitude_min' => '44.00',
                'longitude_max' => '46.00',
            ],
            [
                'name_ar' => 'جازان',
                'name_en' => 'Jazan',
                'country_id' => 7,
                'latitude' => '16.891577976078537',
                'longitude' => '42.5774671143355',
                'latitude_min' => '16.5',
                'latitude_max' => '16.92',
                'longitude_min' => '42.86',
                'longitude_max' => '42.95',
            ],

        ];
        foreach ($cities as $city) {

            City::create(
                [
                    'name_ar' => $city['name_ar'],
                    'name_en' => $city['name_en'],
                    'latitude' => $city['latitude'],
                    'longitude' => $city['longitude'],
                    'latitude_min' => $city['latitude_min'],
                    'latitude_max' => $city['latitude_max'],
                    'longitude_min' => $city['longitude_min'],
                    'longitude_max' => $city['longitude_max'],
                ]
            );
        }
    }
}
