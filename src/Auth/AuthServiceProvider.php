<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth;

use Arcanesoft\Foundation\Auth\Console\{MakeAdmin, MakeUser};
use Arcanesoft\Foundation\Support\Providers\ServiceProvider;

/**
 * Class     AuthServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthServiceProvider extends ServiceProvider
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
            Providers\EventServiceProvider::class,
            Providers\RouteServiceProvider::class,
            Providers\SessionServiceProvider::class,
            Providers\ViewServiceProvider::class,
        ]);

        $this->registerCommands([
            MakeUser::class,
            MakeAdmin::class,
        ]);
    }
}
