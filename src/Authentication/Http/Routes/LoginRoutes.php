<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Http\Routes;

use Arcanedev\Support\Routing\RouteRegistrar;
use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Authentication\Http\Controllers\{LoginController, TwoFactorLoginController};
use Arcanesoft\Foundation\Fortify\LoginRateLimiter;

/**
 * Class     LoginRoutes
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LoginRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const LOGIN_CREATE = 'admin::auth.login.create';
    const LOGIN_STORE  = 'admin::auth.login.store';
    const LOGOUT       = 'admin::auth.logout';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->mapLoginRoutes();
//        $this->mapTwoFactorRoutes();
        $this->mapLogoutRoute();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map login routes.
     */
    protected function mapLoginRoutes(): void
    {
        $this->prefix('login')->name('login.')->middleware(['guest'])->group(function () {
            // admin::auth.login.create
            $this->get('/', [LoginController::class, 'create'])
                 ->name('create');

            // admin::auth.login.store
            $this->post('/', [LoginController::class, 'store'])
                 ->middleware([LoginRateLimiter::middleware()])
                 ->name('store');
        });
    }

    /**
     * Map two factor authentication routes.
     */
    private function mapTwoFactorRoutes(): void
    {
        if ( ! Auth::isTwoFactorEnabled())
            return;

        $this->prefix('two-factor-challenge')->name('two-factor.')->group(function () {
            // admin::auth.login.two-factor.create
            $this->get('/', [TwoFactorLoginController::class, 'create'])
                ->name('create');

            // admin::auth.login.two-factor.store
            $this->post('/', [TwoFactorLoginController::class, 'store'])
                ->name('store');
        });
    }

    /**
     * Map logout route.
     */
    protected function mapLogoutRoute(): void
    {
        // admin::auth.logout
        $this->delete('logout', [LoginController::class, 'destroy'])
             ->name('logout');
    }
}
