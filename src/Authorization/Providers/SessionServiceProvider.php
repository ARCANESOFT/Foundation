<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Providers;

use Arcanesoft\Foundation\Authorization\Repositories\SessionsRepository;
use Arcanesoft\Foundation\Authorization\Session\DatabaseSessionHandler;
use Illuminate\Contracts\Container\Container;
use Illuminate\Session\SessionManager;
use Illuminate\Support\ServiceProvider;

/**
 * Class     SessionServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SessionServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Boot the service provider.
     */
    public function register(): void
    {
        $this->registerCustomSessionHandler($this->app['session']);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register a custom session handler.
     *
     * @param  \Illuminate\Session\SessionManager  $session
     */
    protected function registerCustomSessionHandler(SessionManager $session): void
    {
        $session->extend('arcanesoft', function (Container $app) {
            return new DatabaseSessionHandler($app->make(SessionsRepository::class), $app);
        });
    }
}
