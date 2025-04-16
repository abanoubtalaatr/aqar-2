<?php

namespace Database\Seeders;

use App\Models\Shortcut;
use Illuminate\Database\Seeder;

class shourtcutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shortcut::create([
            'name' => 'Add_Ad',
            'active' => 1,
        ]);
        Shortcut::create([
            'name' => 'Pay_Fees',
            'active' => 1,
        ]);
        Shortcut::create([
            'name' => 'Mortgage',
            'active' => 1,
        ]);
        Shortcut::create([
            'name' => 'Average_Prices',
            'active' => 1,
        ]);
        Shortcut::create([
            'name' => 'Renting_Contracts',
            'active' => 1,
        ]);
        Shortcut::create([
            'name' => 'Highlight_Ad',
            'active' => 1,
        ]);
        Shortcut::create([
            'name' => 'Aqar_Blog',
            'active' => 1,
        ]);
        Shortcut::create([
            'name' => 'Success_Partners',
            'active' => 1,
        ]);
        Shortcut::create([
            'name' => 'User_Agreement',
            'active' => 1,
        ]);
        Shortcut::create([
            'name' => 'Construction_calculator',
            'active' => 1,
        ]);
        Shortcut::create([
            'name' => 'Contact_Us',
            'active' => 1,
        ]);
    }
}
