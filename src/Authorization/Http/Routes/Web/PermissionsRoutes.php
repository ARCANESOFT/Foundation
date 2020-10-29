<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Routes\Web;

use Arcanesoft\Foundation\Authorization\Http\Controllers\PermissionsController;
use Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository;

/**
 * Class     PermissionsRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const PERMISSION_WILDCARD = 'admin_auth_permission';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->prefix('permissions')->name('permissions.')->group(function () {
            // admin::auth.permissions.index
            $this->get('/', [PermissionsController::class, 'index'])
                 ->name('index');

            $this->prefix('{'.static::PERMISSION_WILDCARD.'}')->group(function () {
                // admin::auth.permissions.show
                $this->get('/', [PermissionsController::class, 'show'])
                     ->name('show');

                static::mapRouteClasses([
                    Permissions\RolesRoutes::class,
                ]);
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository  $repo
     */
    public function bindings(PermissionsRepository $repo): void
    {
        $this->bind(static::PERMISSION_WILDCARD, function (string $uuid) use ($repo) {
            return $repo->firstOrFailWhereUuid($uuid);
        });

        static::bindRouteClasses([
            Permissions\RolesRoutes::class,
        ]);
    }
}
