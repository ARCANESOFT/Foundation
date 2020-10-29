<?php

/* -----------------------------------------------------------------
 |  Policies
 | -----------------------------------------------------------------
 */

return [

    // Core
    Arcanesoft\Foundation\Core\Policies\DashboardPolicy::class,

    // System
    Arcanesoft\Foundation\System\Policies\InformationPolicy::class,
    Arcanesoft\Foundation\System\Policies\AbilitiesPolicy::class,
    Arcanesoft\Foundation\System\Policies\MaintenancePolicy::class,
    Arcanesoft\Foundation\System\Policies\LogViewerPolicy::class,
    Arcanesoft\Foundation\System\Policies\RouteViewerPolicy::class,

    // Auth
    Arcanesoft\Foundation\Authorization\Policies\DashboardPolicy::class,
    Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy::class,
    Arcanesoft\Foundation\Authorization\Policies\UsersPolicy::class,
    Arcanesoft\Foundation\Authorization\Policies\RolesPolicy::class,
    Arcanesoft\Foundation\Authorization\Policies\PermissionsPolicy::class,
    Arcanesoft\Foundation\Authorization\Policies\PasswordResetsPolicy::class,
    Arcanesoft\Foundation\Authorization\Policies\SessionsPolicy::class,
    Arcanesoft\Foundation\Authorization\Policies\SettingsPolicy::class,

];
