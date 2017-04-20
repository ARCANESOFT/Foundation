<?php

use Arcanesoft\Auth\Models\Role;

return [
    'title'       => 'foundation::sidebar.dashboard',
    'name'        => 'foundation-home',
    'route'       => 'admin::foundation.home',
    'icon'        => 'fa fa-fw fa-dashboard',
    'roles'       => [Role::ADMINISTRATOR, Role::MODERATOR],
    'permissions' => [
        //
    ],
];
