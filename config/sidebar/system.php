<?php

use Arcanesoft\Auth\Models\Role;
use Arcanesoft\Foundation\Policies\LogViewerPolicy;

return [
    'title'       => 'System',
    'name'        => 'foundation-system',
    'icon'        => 'fa fa-fw fa-desktop',
    'roles'       => [Role::ADMINISTRATOR],
    'permissions' => [],
    'children'    => [
        [
            'title'       => 'Informations',
            'name'        => 'foundation-system-information',
            'route'       => 'admin::foundation.system.information.index',
            'icon'        => 'fa fa-fw fa-info-circle',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [
                //
            ],
        ],
        [
            'title'       => 'LogViewer',
            'name'        => 'foundation-system-logviewer',
            'route'       => 'admin::foundation.system.log-viewer.index',
            'icon'        => 'fa fa-fw fa-book',
            'roles'       => [Role::ADMINISTRATOR, 'logviewer-manager'],
            'permissions' => [LogViewerPolicy::PERMISSION_DASHBOARD],
        ],
        [
            'title'       => 'Routes',
            'name'        => 'foundation-system-routes',
            'route'       => 'admin::foundation.system.routes.index',
            'icon'        => 'fa fa-fw fa-map-signs',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [],
        ],
    ],
];
