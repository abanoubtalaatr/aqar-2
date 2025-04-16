<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Define modules with standard CRUD permissions and special actions
        $modules = [
            'user' => ['create', 'read', 'update','show', 'delete'],
            'category' => ['create', 'read', 'update','show', 'delete'],
            'ad' => ['create', 'read', 'update', 'delete', 'show','export'],
            'order' => ['create', 'read', 'update', 'delete', 'show'],
            'role' => ['create', 'read', 'update', 'delete','show'],
            'admin' => ['create', 'read', 'update', 'delete', 'show'],
            'random-message' => ['create', 'read', 'update','show', 'delete'],
            'dashboard' => ['read'],
            'page' => ['update', 'read'],
            'contact' => ['read', 'response', 'delete'],
            'notification' => ['create', 'read', 'update','show', 'delete'],
            'city' => ['create', 'read', 'update','show', 'delete'],
            'license' => ['create', 'read', 'update','show', 'delete'],
            'article' => ['create', 'read', 'update','show', 'delete'],
            'faq-type' => ['create', 'read', 'update','show', 'delete'],
            'faq' => ['create', 'read', 'update','show', 'delete'],
            'service-type' => ['create', 'read', 'update','show', 'delete'],
            'contact-service' => ['create', 'read', 'update','show', 'delete'],
            'contact-type' => ['create', 'read', 'update','show', 'delete'],
            'category' => ['create', 'read', 'update','show', 'delete'],
            'setting' => ['read', 'update'],
            'statistic' => ['read', 'export'],
            'service-provider' => ['read','create','delete','update'],
            'report-ad' => ['read','delete','reply'],
            'report-order' => ['read','delete','reply'],
            'partner' => ['read','delete','update','create'],
        ];

        // Create or get the 'admin' role
        $adminRole = Role::firstOrCreate(['name' => 'super-admin']);

        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                $permission = Permission::updateOrCreate(
                    ['name' => "{$module}-{$action}"],
                    ['guard_name' => 'web']
                );

                // Assign permission to the admin role
                $adminRole->givePermissionTo($permission);
            }
        }

        // Assign admin role to user with email admin@garas.com
        $adminUser = User::where('email', 'admin@garas.com')->first();
        if ($adminUser) {
            $adminUser->assignRole('super-admin');
        }
    }
}
