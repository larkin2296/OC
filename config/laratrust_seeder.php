<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'system' => 'm',
            'user' => 'c,r,u,d,m',
            'role' => 'c,r,u,d,m',
            'permission' => 'c,r,u,d,m',
            'menu' => 'c,r,u,d,s,m',
        ],
        'admin' => [
            'system' => 'm',
            'user' => 'c,r,u,d,m',
            'role' => 'c,r,u,d,m',
            'permission' => 'c,r,u,d,m',
            'menu' => 'c,r,u,d,s,m',
        ],
        'user' => [
            'system' => 'm',
            'user' => 'c,r,u,d,m',
            'role' => 'c,r,u,d,m',
            'permission' => 'c,r,u,d,m',
            'menu' => 'c,r,u,d,s,m',
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        's' => 'sort',
        'm' => 'manage',
    ]
];
