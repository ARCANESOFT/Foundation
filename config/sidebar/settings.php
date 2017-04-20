<?php

use Arcanesoft\Auth\Models\Role;

return [
    'title'       => 'foundation::sidebar.settings',
    'name'        => 'foundation-settings',
    'icon'        => 'fa fa-fw fa-cogs',
    'roles'       => [Role::ADMINISTRATOR],
    'permissions' => [],
    'children'    => [
        [
            'title'       => 'foundation::sidebar.settings-generals',
            'name'        => 'foundation-settings-generals',
            'route'       => 'admin::foundation.settings.index',
            'icon'        => 'fa fa-fw fa-wrench',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [],
        ],
//        [
//            'title'       => 'foundation::sidebar.settings-modules',
//            'name'        => 'foundation-modules',
//            'route'       => 'admin::foundation.modules.index',
//            'icon'        => 'fa fa-fw fa-cubes',
//            'roles'       => [Role::ADMINISTRATOR],
//            'permissions' => [],
//        ],
    ],
];
