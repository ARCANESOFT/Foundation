<?php

use Arcanesoft\Auth\Models\Role;

return [
    'title'       => 'Dashboard',
    'name'        => 'foundation-home',
    'route'       => 'foundation::home',
    'icon'        => 'fa fa-fw fa-dashboard',
    'roles'       => [Role::ADMINISTRATOR, Role::MODERATOR],
    'permissions' => [],
];
