<?php

// TODO: Find an eloquent way to register and select metrics

return [

    /* -----------------------------------------------------------------
     |  Registered Metrics
     | -----------------------------------------------------------------
     */

    'registered' => [

        // Auth - Administrators
        Arcanesoft\Foundation\Authorization\Metrics\Administrators\TotalAdministrators::class,
        Arcanesoft\Foundation\Authorization\Metrics\Administrators\NewAdministrators::class,
        Arcanesoft\Foundation\Authorization\Metrics\Administrators\ActivatedAdministrators::class,
        Arcanesoft\Foundation\Authorization\Metrics\Administrators\AdministratorsPerDay::class,

        // Auth - Users
        Arcanesoft\Foundation\Authorization\Metrics\Users\ActivatedUsers::class,
        Arcanesoft\Foundation\Authorization\Metrics\Users\NewUsers::class,
        Arcanesoft\Foundation\Authorization\Metrics\Users\TotalUsers::class,
        Arcanesoft\Foundation\Authorization\Metrics\Users\UsersPerMinute::class,
        Arcanesoft\Foundation\Authorization\Metrics\Users\UsersPerHour::class,
        Arcanesoft\Foundation\Authorization\Metrics\Users\UsersPerDay::class,
        Arcanesoft\Foundation\Authorization\Metrics\Users\UsersPerWeek::class,
        Arcanesoft\Foundation\Authorization\Metrics\Users\UsersPerMonth::class,
        Arcanesoft\Foundation\Authorization\Metrics\Users\VerifiedEmails::class,

        // Auth - Roles
        Arcanesoft\Foundation\Authorization\Metrics\Roles\TotalRoles::class,
        Arcanesoft\Foundation\Authorization\Metrics\Roles\TotalUsersByRoles::class,

        // Auth - Password Resets
        Arcanesoft\Foundation\Authorization\Metrics\PasswordResets\PasswordResetsPerDay::class,
        Arcanesoft\Foundation\Authorization\Metrics\PasswordResets\TotalPasswordResets::class,

        // System - LogViewer
        Arcanesoft\Foundation\System\Metrics\LogViewer\LogFilesCount::class,
        Arcanesoft\Foundation\System\Metrics\LogViewer\LogEntriesCountByLevel::class,

    ],

    /* -----------------------------------------------------------------
     |  Selected Metrics
     | -----------------------------------------------------------------
     */

    'selected' => [

        // Authorization
        //------------------------------------

        'authorization' => [
            'dashboard' => [
                'index' => [
                    Arcanesoft\Foundation\Authorization\Metrics\Users\TotalUsers::class,
                    Arcanesoft\Foundation\Authorization\Metrics\Users\UsersPerDay::class,
                ],
            ],

            'users' => [
                Arcanesoft\Foundation\Authorization\Metrics\Users\TotalUsers::class,
                Arcanesoft\Foundation\Authorization\Metrics\Users\NewUsers::class,
                Arcanesoft\Foundation\Authorization\Metrics\Users\VerifiedEmails::class,
                Arcanesoft\Foundation\Authorization\Metrics\Users\ActivatedUsers::class,
                Arcanesoft\Foundation\Authorization\Metrics\Users\UsersPerDay::class,
            ],

            'administrators' => [
                Arcanesoft\Foundation\Authorization\Metrics\Administrators\TotalAdministrators::class,
                Arcanesoft\Foundation\Authorization\Metrics\Administrators\NewAdministrators::class,
                Arcanesoft\Foundation\Authorization\Metrics\Administrators\ActivatedAdministrators::class,
                Arcanesoft\Foundation\Authorization\Metrics\Administrators\AdministratorsPerDay::class,
            ],

            'roles' => [
                Arcanesoft\Foundation\Authorization\Metrics\Roles\TotalUsersByRoles::class,
                Arcanesoft\Foundation\Authorization\Metrics\Roles\TotalRoles::class,
            ],

            'password-resets' => [
                Arcanesoft\Foundation\Authorization\Metrics\PasswordResets\TotalPasswordResets::class,
                Arcanesoft\Foundation\Authorization\Metrics\PasswordResets\PasswordResetsPerDay::class,
            ],
        ],
    ],

];
