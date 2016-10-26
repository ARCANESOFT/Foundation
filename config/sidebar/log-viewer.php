<?php

use Arcanesoft\Auth\Models\Role;
use Arcanesoft\Foundation\Policies\LogViewerPolicy;

return [
    'title'       => 'LogViewer',
    'name'        => 'foundation-logviewer',
    'route'       => 'foundation::log-viewer.index',
    'icon'        => 'fa fa-fw fa-book',
    'roles'       => [Role::ADMINISTRATOR, 'logviewer-manager'],
    'permissions' => [LogViewerPolicy::PERMISSION_DASHBOARD],
];
