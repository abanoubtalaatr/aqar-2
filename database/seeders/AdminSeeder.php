<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $super_admin = User::query()->firstOrCreate(
            [
                'email' => 'admin@garas.com',
            ],
            [
                'name' => 'Super Admin',
                'phone' => fake()->phoneNumber(),
                'password' => 'Elryad@!1256',

                'is_active' => true,
            ]
        );


        $super_admin->addRole('super-admin');
    }
}
