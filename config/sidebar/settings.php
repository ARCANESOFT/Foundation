<?php

use Arcanesoft\Auth\Models\Role;

return [
    'title'       => 'Settings',
    'name'        => 'foundation-settings',
    'icon'        => 'fa fa-fw fa-cogs',
    'roles'       => [Role::ADMINISTRATOR],
    'permissions' => [],
    'children'    => [
        [
            'title'       => 'Generals',
            'name'        => 'foundation-settings-generals',
            'route'       => 'foundation::settings.index',
            'icon'        => 'fa fa-fw fa-wrench',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [],
        ],[
            'title'       => 'Modules',
            'name'        => 'foundation-settings-modules',
            'route'       => 'auth::foundation.dashboard',
            'icon'        => 'fa fa-fw fa-cubes',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [],
        ],
    ],
];
