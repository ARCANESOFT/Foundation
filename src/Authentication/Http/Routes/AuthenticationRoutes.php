<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Http\Routes;

use Arcanesoft\Foundation\Support\Http\AdminRouteRegistrar as RouteRegistrar;

/**
 * Class     AuthenticationRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthenticationRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->adminGroup(function () {
            $this->prefix('auth')->name('auth.')->group(function (): void {
                static::mapRouteClasses([
                    ConfirmPasswordRoutes::class,
                    LoginRoutes::class,
                    PasswordResetRoutes::class,
                ]);
            });
        });
    }

    /**
     * Get the admin middleware.
     *
     * @return array
     */
    protected function getAdminMiddleware(): array
    {
        return ['web'];
    }
}
