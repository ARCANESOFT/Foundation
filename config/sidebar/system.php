<?php

use Arcanesoft\Auth\Models\Role;
use Arcanesoft\Foundation\Policies\BackupPolicy;
use Arcanesoft\Foundation\Policies\LogViewerPolicy;

return [
    'title'       => 'foundation::sidebar.system',
    'name'        => 'foundation-system',
    'icon'        => 'fa fa-fw fa-desktop',
    'roles'       => [Role::ADMINISTRATOR],
    'permissions' => [],
    'children'    => [
        [
            'title'       => 'foundation::sidebar.system-informations',
            'name'        => 'foundation-system-information',
            'route'       => 'admin::foundation.system.information.index',
            'icon'        => 'fa fa-fw fa-info-circle',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                //
            ],
        ],
        [
            'title'       => 'foundation::sidebar.system-log-viewer',
            'name'        => 'foundation-system-logviewer',
            'route'       => 'admin::foundation.system.log-viewer.index',
            'icon'        => 'fa fa-fw fa-book',
            'roles'       => [Role::ADMINISTRATOR, 'logviewer-manager'],
            'permissions' => [
                LogViewerPolicy::PERMISSION_DASHBOARD,
            ],
        ],
        [
            'title'       => 'foundation::sidebar.system-routes',
            'name'        => 'foundation-system-routes',
            'route'       => 'admin::foundation.system.routes.index',
            'icon'        => 'fa fa-fw fa-map-signs',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [],
        ],
        [
            'title'       => 'foundation::sidebar.backups',
            'name'        => 'foundation-system-backups',
            'route'       => 'admin::foundation.system.backups.index',
            'icon'        => 'fa fa-fw fa-database',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                BackupPolicy::PERMISSION_LIST,
            ],
        ]
    ],
];
