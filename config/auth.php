<?php

return [

    /* -----------------------------------------------------------------
     |  Authentication
     | -----------------------------------------------------------------
     */

    'authentication' => [

        'login'      => [
            'enabled' => true,
        ],

        'register'   => [
            'enabled' => true,

            'login-after-registered' => true,
        ],

        'two-factor' => [
            'enabled' => true,
        ],

        'socialite'  => [
            'enabled'   => true,

            'providers' => [
                'facebook' => [
                    'name'    => 'Facebook',
                    'icon'    => 'fab fa-fw fa-facebook',
                    'enabled' => true,
                ],

                'google' => [
                    'name'    => 'Google',
                    'icon'    => 'fab fa-fw fa-google',
                    'enabled' => true,
                ],

                'twitter' => [
                    'name'    => 'Twitter',
                    'icon'    => 'fab fa-fw fa-twitter',
                    'enabled' => true,
                ],

                'github' => [
                    'name'    => 'GitHub',
                    'icon'    => 'fab fa-fw fa-github',
                    'enabled' => true,
                ],
            ],
        ],

    ],

    'limiters' => [

        'login' => [
            'enabled'  => true,
            'throttle' => '5',
        ],

    ],

    /* -----------------------------------------------------------------
     |  Database
     | -----------------------------------------------------------------
     */

    'database' => [

        // Connections
        // ----------------------------------

        'connection' => env('DB_CONNECTION', 'mysql'),

        // Tables
        // ----------------------------------

        'prefix'     => 'auth_',

        'tables'     => [
            'administrators'      => 'administrators',
            'users'               => 'users',
            'roles'               => 'roles',
            'permissions'         => 'permissions',
            'permissions-groups'  => 'permissions_groups',
            'password-resets'     => 'password_resets',
            'throttles'           => 'throttles',
            'administrator-role'  => 'administrator_role',
            'permission-role'     => 'permission_role',
            'sessions'            => 'sessions',
            'socialite-providers' => 'socialite_providers',
        ],

         // Models
         // ----------------------------------

        'models' => [
            'user'               => App\Models\User::class,
            'administrator'      => Arcanesoft\Foundation\Auth\Models\Administrator::class,
            'role'               => Arcanesoft\Foundation\Auth\Models\Role::class,
            'permission'         => Arcanesoft\Foundation\Auth\Models\Permission::class,
            'permissions-group'  => Arcanesoft\Foundation\Auth\Models\PermissionsGroup::class,
            'password-resets'    => Arcanesoft\Foundation\Auth\Models\PasswordReset::class,
            'session'            => Arcanesoft\Foundation\Auth\Models\Session::class,
            'socialite-provider' => Arcanesoft\Foundation\Auth\Models\SocialiteProvider::class,
        ],

    ],

    /* -----------------------------------------------------------------
     |  Administrators
     | -----------------------------------------------------------------
     */

    'administrators' => [
        'emails' => [
            'admin@example.com',
        ],
    ],

];
