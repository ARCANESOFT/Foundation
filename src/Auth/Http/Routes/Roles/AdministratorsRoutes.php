<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes\Roles;

use Arcanesoft\Foundation\Auth\Http\Controllers\Roles\AdministratorsController;
use Arcanesoft\Foundation\Auth\Http\Routes\{RolesRoutes, AbstractRouteRegistrar};
use Arcanesoft\Foundation\Auth\Repositories\RolesRepository;
use Illuminate\Routing\Route;

/**
 * Class     AdministratorsRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdministratorsRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const USER_WILDCARD = 'admin_auth_role_administrator';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->prefix('administrators')->name('administrators.')->group(function () {
            $this->prefix('{'.self::USER_WILDCARD.'}')->group(function () {
                // admin::auth.roles.administrators.detach
                $this->delete('detach', [AdministratorsController::class, 'detach'])
                     ->name('detach');
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $repo
     */
    public function bindings(RolesRepository $repo): void
    {
        $this->bind(self::USER_WILDCARD, function (string $uuid, Route $route) use ($repo) {
            /** @var  \Arcanesoft\Foundation\Auth\Models\Role  $role */
            $role = $route->parameter(RolesRoutes::ROLE_WILDCARD);

            return $repo->firstAdministratorWithUuidOrFail($role, $uuid);
        });
    }
}
