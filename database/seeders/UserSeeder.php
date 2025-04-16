<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create(
            [
                'name' => 'Fake User',
                'phone' => '01060809341',
                'password' => 'Elryad@!1256',
                'about' => 'first user on garas website',
                'membership_type' => 0,
                'is_active' => true,
            ]
        );
    }
}
