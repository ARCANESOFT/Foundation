<?php

return [

    /* -----------------------------------------------------------------
     |  Items
     | -----------------------------------------------------------------
     */

    'items' => [
        // Dashboard
        [
            'name'        => 'foundation::dashboard',
            'title'       => 'Dashboard',
            'icon'        => 'fa fa-fw fa-tachometer-alt',
            'route'       => 'admin::index',
            'roles'       => [],
            'permissions' => [
                'admin::dashboard.index',
            ],
        ],

        // Modules' sidebar items
        'arcanesoft.blog.sidebar.items',
        'arcanesoft.seo.sidebar.items',
        'arcanesoft.media.sidebar.items',
        'arcanesoft.passport.sidebar.items',

        // Authorization
        [
            'name'        => 'foundation::cms',
            'title'       => 'CMS',
            'icon'        => 'fas fa-fw fa-cubes',
            'roles'       => [],
            'permissions' => [],
            'children'    => [
                [
                    'name'        => 'foundation::cms.dashboard',
                    'title'       => 'Statistics',
                    'icon'        => 'fas fa-fw fa-tachometer-alt',
                    'route'       => 'admin::cms.index',
                    'roles'       => ['cms-moderator'],
                    'permissions' => [
                        'admin::cms.index',
                    ],
                ],
                [
                    'name'        => 'foundation::cms.categories',
                    'title'       => 'Categories',
                    'icon'        => 'fas fa-fw fa-stream',
                    'route'       => 'admin::cms.categories.index',
                    'roles'       => ['cms-moderator'],
                    'permissions' => [
                        'admin::cms.categories.index',
                    ],
                ],
                [
                    'name'        => 'foundation::cms.languages',
                    'title'       => 'Languages',
                    'icon'        => 'fas fa-fw fa-language',
                    'route'       => 'admin::cms.languages.index',
                    'roles'       => ['cms-moderator'],
                    'permissions' => [
                        'admin::cms.languages.index',
                    ],
                ],
            ],
        ],

        // Authorization
        [
            'name'        => 'foundation::authorization',
            'title'       => 'Authorization',
            'icon'        => 'fas fa-fw fa-key',
            'roles'       => [],
            'permissions' => [],
            'children'    => [
                [
                    'name'        => 'foundation::authorization.dashboard',
                    'title'       => 'Statistics',
                    'icon'        => 'fas fa-fw fa-tachometer-alt',
                    'route'       => 'admin::authorization.index',
                    'roles'       => ['auth-moderator'],
                    'permissions' => [
                        'admin::authorization.index',
                    ],
                ],
                [
                    'name'        => 'foundation::authorization.users',
                    'title'       => 'Users',
                    'icon'        => 'fas fa-fw fa-users',
                    'route'       => 'admin::authorization.users.index',
                    'roles'       => ['auth-moderator'],
                    'permissions' => [
                        'admin::authorization.users.index',
                    ],
                ],
                [
                    'name'        => 'foundation::authorization.administrators',
                    'title'       => 'Administrators',
                    'icon'        => 'fas fa-fw fa-user-secret',
                    'route'       => 'admin::authorization.administrators.index',
                    'roles'       => ['auth-moderator'],
                    'permissions' => [
                        'admin::authorization.administrators.index',
                    ],
                ],
                [
                    'name'        => 'foundation::authorization.roles',
                    'title'       => 'Roles',
                    'icon'        => 'fas fa-fw fa-user-tag',
                    'route'       => 'admin::authorization.roles.index',
                    'roles'       => ['auth-moderator'],
                    'permissions' => [
                        'admin::authorization.roles.index',
                    ],
                ],
                [
                    'name'        => 'foundation::authorization.permissions',
                    'title'       => 'Permissions',
                    'icon'        => 'fas fa-fw fa-shield-alt',
                    'route'       => 'admin::authorization.permissions.index',
                    'roles'       => ['auth-moderator'],
                    'permissions' => [
                        'admin::authorization.permissions.index',
                    ],
                ],
                [
                    'name'        => 'foundation::authorization.password-resets',
                    'title'       => 'Password Resets',
                    'icon'        => 'fas fa-fw fa-sync',
                    'route'       => 'admin::authorization.password-resets.index',
                    'roles'       => ['auth-moderator'],
                    'permissions' => [
                        'admin::authorization.password-resets.index',
                    ],
                ],
                [
                    'name'        => 'foundation::authorization.settings',
                    'title'       => 'Settings',
                    'icon'        => 'fas fa-fw fa-cog',
                    'route'       => 'admin::authorization.settings.index',
                    'roles'       => ['auth-moderator'],
                    'permissions' => [
                        'admin::authorization.settings.index',
                    ],
                ],
            ],
        ],

        // System
        [
            'name'        => 'foundation::system',
            'title'       => 'System',
            'icon'        => 'fas fa-fw fa-desktop',
            'route'       => 'admin::index',
            'roles'       => [],
            'permissions' => [],
            'children'    => [
                [
                    'name'        => 'foundation::system.info',
                    'title'       => 'Information',
                    'icon'        => 'fas fa-fw fa-info-circle',
                    'route'       => 'admin::system.index',
                    'roles'       => [],
                    'permissions' => ['admin::system.index'],
                ],
                [
                    'name'        => 'foundation::system.log-viewer',
                    'title'       => 'LogViewer',
                    'icon'        => 'fas fa-fw fa-clipboard-list',
                    'route'       => 'admin::system.log-viewer.index',
                    'roles'       => [],
                    'permissions' => ['admin::system.log-viewer.index'],
                ],
                [
                    'name'        => 'foundation::system.routes-viewer',
                    'title'       => 'Routes Viewer',
                    'icon'        => 'fas fa-fw fa-map-signs',
                    'route'       => 'admin::system.routes-viewer.index',
                    'roles'       => [],
                    'permissions' => ['admin::system.routes-viewer.index'],
                ],
            ],
        ],

        'arcanesoft.backups.sidebar.items',
    ],

];
