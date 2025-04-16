<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LaratrustSeeder::class);
        // $this->call(CountrySeeder::class);
        // $this->call(CitySeeder::class);
        // $this->call(NeighborhoodSeeder::class);
        // $this->call(InfoSeeder::class);
        // $this->call(AdminSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(CategoryKeySeeder::class);
        // $this->call(CurrencySeeder::class);

    }
}
