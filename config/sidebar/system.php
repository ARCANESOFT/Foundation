<?php

use Arcanesoft\Auth\Models\Role;

return [
    'title'       => 'System',
    'name'        => 'foundation-system',
    'icon'        => 'fa fa-fw fa-desktop',
    'roles'       => [Role::ADMINISTRATOR],
    'permissions' => [],
    'children'    => [
        [
            'title'       => 'Routes',
            'name'        => 'foundation-system-routes',
            'route'       => 'foundation::system.routes.index',
            'icon'        => 'fa fa-fw fa-map-signs',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [],
        ],
    ],
];
