<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication;

use Arcanesoft\Foundation\Support\Providers\ServiceProvider;

/**
 * Class     AuthenticationServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthenticationServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerProviders([
            Providers\RouteServiceProvider::class,
        ]);
    }
}
