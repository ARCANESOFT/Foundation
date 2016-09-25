<?php

use Arcanesoft\Auth\Models\Role;

return [
    'title'       => 'LogViewer',
    'name'        => 'foundation-logviewer',
    'route'       => 'foundation::log-viewer.index',
    'icon'        => 'fa fa-fw fa-book',
    'roles'       => [Role::ADMINISTRATOR],
    'permissions' => [],
];
