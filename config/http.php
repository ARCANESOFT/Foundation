<?php

return [

    /* -----------------------------------------------------------------
     |  Middleware
     | -----------------------------------------------------------------
     */

    'middleware' => [
        'ajax'                           => Arcanesoft\Foundation\Core\Http\Middleware\EnsureIsAjaxRequest::class,
        'authenticated'                  => Arcanesoft\Foundation\Core\Http\Middleware\EnsureIsAuthenticated::class,
        'activated'                      => Arcanesoft\Foundation\Core\Http\Middleware\EnsureIsActive::class,
        'administrator'                  => Arcanesoft\Foundation\Core\Http\Middleware\EnsureIsAdmin::class,
        'administrator.password.confirm' => Arcanesoft\Foundation\Core\Http\Middleware\RequirePassword::class,
    ],

    'middleware-group' => [
        'arcanesoft' => [
            'authenticated',
            'activated',
            'administrator',
        ],
    ],

];
