<?php

return [
    /* ------------------------------------------------------------------------------------------------
     |  Route settings
     | ------------------------------------------------------------------------------------------------
     */
    'route'     => [
        'prefix'     => 'dashboard',
        'as'         => 'foundation::',
        'middleware' => ['web', 'auth', 'admin'],
        'namespace'  => 'Arcanesoft\\Foundation\\Http\\Controllers',
    ],

    /* ------------------------------------------------------------------------------------------------
     |  Foundation Template
     | ------------------------------------------------------------------------------------------------
     */
    'template'  => 'foundation::_template.master',

    /* ------------------------------------------------------------------------------------------------
     |  Sidebar
     | ------------------------------------------------------------------------------------------------
     */
    'sidebar'   => [
        'items' => [
            'arcanesoft.sidebar.foundation.dashboard',
            'arcanesoft.sidebar.auth.main',
            // 'arcanesoft.sidebar.pages.main',
            // 'arcanesoft.sidebar.blog.main',
            // 'arcanesoft.sidebar.media.main',
            // 'arcanesoft.sidebar.tracker.main',
            'arcanesoft.sidebar.foundation.settings',
            'arcanesoft.sidebar.foundation.system',
        ],
    ],

    /* ------------------------------------------------------------------------------------------------
     |  Modules
     | ------------------------------------------------------------------------------------------------
     */
    'modules' => [
        'setup' => [
            //
        ],
    ],

    /* ------------------------------------------------------------------------------------------------
     |  LogViewer
     | ------------------------------------------------------------------------------------------------
     */
    'log-viewer' => [
        'per-page'     => 30,

        'filter-route' => 'foundation::system.log-viewer.logs.filter',
    ],

    /* ------------------------------------------------------------------------------------------------
     |  RoutesViewer
     | ------------------------------------------------------------------------------------------------
     */
    'routes-viewer' => [
        'per-page' => 30,

        'uris'     => [
            'hide' => [
                '_debugbar'
            ],
        ],

        'methods'  => [
            'hide' => [
                'HEAD',
            ],

            'colors' => [
                'GET'    => 'success',
                'HEAD'   => 'default',
                'POST'   => 'primary',
                'PUT'    => 'warning',
                'PATCH'  => 'info',
                'DELETE' => 'danger',
            ],
        ],
    ],
];
