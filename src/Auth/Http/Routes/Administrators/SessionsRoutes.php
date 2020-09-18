<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes\Administrators;

use Arcanesoft\Foundation\Auth\Http\Controllers\Administrators\SessionsController;
use Arcanesoft\Foundation\Auth\Http\Routes\AbstractRouteRegistrar;
use Arcanesoft\Foundation\Auth\Repositories\SessionsRepository;

/**
 * Class     SessionsRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SessionsRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const WILDCARD_SESSION = 'admin_auth_administrator_session';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->name('sessions.')->name('prefix')->group(function () {
            $this->prefix('{'.static::WILDCARD_SESSION.'}')->group(function () {
                $this->delete('delete', [SessionsController::class, 'delete'])
                     ->name('delete'); // admin::auth.administrators.sessions.delete
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\SessionsRepository  $repo
     */
    public function bindings(SessionsRepository $repo): void
    {
        $this->bind(static::WILDCARD_SESSION, function (string $uuid) use ($repo) {
            return $repo->firstByIdOrFail($uuid);
        });
    }
}
