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
    Arcanesoft\Foundation\Auth\Policies\DashboardPolicy::class,
    Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy::class,
    Arcanesoft\Foundation\Auth\Policies\UsersPolicy::class,
    Arcanesoft\Foundation\Auth\Policies\RolesPolicy::class,
    Arcanesoft\Foundation\Auth\Policies\PermissionsPolicy::class,
    Arcanesoft\Foundation\Auth\Policies\PasswordResetsPolicy::class,
    Arcanesoft\Foundation\Auth\Policies\SessionsPolicy::class,
    Arcanesoft\Foundation\Auth\Policies\SettingsPolicy::class,

];
