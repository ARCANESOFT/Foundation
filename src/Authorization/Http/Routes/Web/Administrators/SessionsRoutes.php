<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Routes\Web\Administrators;

use Arcanesoft\Foundation\Authorization\Http\Controllers\Administrators\SessionsController;
use Arcanesoft\Foundation\Authorization\Http\Routes\Web\RouteRegistrar;
use Arcanesoft\Foundation\Authorization\Repositories\SessionsRepository;

/**
 * Class     SessionsRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SessionsRoutes extends RouteRegistrar
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
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\SessionsRepository  $repo
     */
    public function bindings(SessionsRepository $repo): void
    {
        $this->bind(static::WILDCARD_SESSION, function (string $uuid) use ($repo) {
            return $repo->firstByIdOrFail($uuid);
        });
    }
}
