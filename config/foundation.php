<?php

return [
    /* ------------------------------------------------------------------------------------------------
     |  Route settings
     | ------------------------------------------------------------------------------------------------
     */
    'route'     => [
        //
    ],

    /* ------------------------------------------------------------------------------------------------
     |  Foundation Template
     | ------------------------------------------------------------------------------------------------
     */
    'template'  => 'foundation::admin._template.master',

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
            // 'arcanesoft.sidebar.seo.main',
            'arcanesoft.sidebar.foundation.settings',
            'arcanesoft.sidebar.foundation.system',
        ],
    ],

    /* ------------------------------------------------------------------------------------------------
     |  Modules
     | ------------------------------------------------------------------------------------------------
     */
    'modules' => [
        'providers' => [
            Arcanesoft\Auth\AuthServiceProvider::class,
            // Arcanesoft\Blog\BlogServiceProvider::class,
            // Arcanesoft\Media\MediaServiceProvider::class,
            // Arcanesoft\Tracker\TrackerServiceProvider::class,
            // Arcanesoft\Seo\SeoServiceProvider::class,
        ],
        'setup' => [
            //
        ],
    ],

    /* ------------------------------------------------------------------------------------------------
     |  Dashboards
     | ------------------------------------------------------------------------------------------------
     */
    'dashboards' => [
        'auth::admin._composers.dashboard',
        // 'tracker::admin._composers.dashboard',
    ],

    /* ------------------------------------------------------------------------------------------------
     |  LogViewer
     | ------------------------------------------------------------------------------------------------
     */
    'log-viewer' => [
        'per-page'     => 30,

        'filter-route' => 'admin::foundation.system.log-viewer.logs.filter',
    ],

    /* ------------------------------------------------------------------------------------------------
     |  RoutesViewer
     | ------------------------------------------------------------------------------------------------
     */
    'routes-viewer' => [
        'per-page' => 30,

        'uris'     => [
            'excluded' => [
                '_debugbar'
            ],
        ],

        'methods'  => [
            'excluded' => [
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
