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
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'articles'=>'c,r,u,d',
            'profile' => 'r,u',
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'articles'=>'c,r,u,v',
            'profile' => 'r,u',
        ],
        'user' => [
            'users'=>'r,v',
            'articles'=>'c,r,v',
            'profile' => 'r,u',
        ],
        'manager' => [
            'users' => 'c,r,u',
            'articles'=>'c,r,v,u',
            'profile'=>'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'v'=>'view',
    ],
];
