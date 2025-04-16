<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super-admin' => [
            'dashboard' => 'r',  // For Browsing Dashboard
            'roles' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'reports' => 'c,r,u,d',
            'contacts' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'ads' => 'c,r,u,d',
            'countries' => 'c,r,u,d',
            'cities' => 'c,r,u,d',
            'blogs' => 'c,r,u,d',
            'neighborhoods' => 'c,r,u,d',
            'rates' => 'c,r,u,d',
            'settings' => 'u',
            'currencies' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'partners' => 'c,r,u,d',
            'keys' => 'c,r,u,d',
            'constructions' => 'c,r,u,d',
            'messages' => 'c,r,u,d',

        ],
        'admin' => [
            'dashboard' => 'r', // For Browsing Dashboard
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
    ],

    'roles_translations' => [
        'super-admin' => [
            'en' => 'Super Admin',
            'ar' => 'مشرف عام',
        ],
        'admin' => [
            'en' => 'Admin',
            'ar' => 'مشرف',
        ],
    ],

    'roles_settings' => [
        'super-admin' => [
            'is_editable' => false,
            'is_deletable' => false,
            'has_additional_data' => false,
        ],
        'admin' => [
            'is_editable' => true,
            'is_deletable' => false,
            'has_additional_data' => false,
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
