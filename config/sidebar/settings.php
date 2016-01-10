<?php

return [
    'title'       => 'Settings',
    'name'        => 'foundation-settings',
    'icon'        => 'fa fa-fw fa-cogs',
    'roles'       => [],
    'permissions' => [],
    'children'    => [
        [
            'title'       => 'Generals',
            'name'        => 'foundation-settings-generals',
            'route'       => 'auth::foundation.dashboard',
            'icon'        => 'fa fa-fw fa-wrench',
            'roles'       => [],
            'permissions' => [],
        ],[
            'title'       => 'Themes',
            'name'        => 'foundation-settings-themes',
            'route'       => 'auth::foundation.dashboard',
            'icon'        => 'fa fa-fw fa-paint-brush',
            'roles'       => [],
            'permissions' => [],
        ],[
            'title'       => 'Modules',
            'name'        => 'foundation-settings-modules',
            'route'       => 'auth::foundation.dashboard',
            'icon'        => 'fa fa-fw fa-cubes',
            'roles'       => [],
            'permissions' => [],
        ],
    ],
];
