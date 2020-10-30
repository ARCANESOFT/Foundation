<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify;

use Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\Provider as ProviderContract;
use Arcanesoft\Foundation\Fortify\Services\TwoFactorAuthentication\TwoFactorAuthenticationProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class     FortifyServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FortifyServiceProvider extends ServiceProvider
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
        $this->app->singleton(
            ProviderContract::class,
            TwoFactorAuthenticationProvider::class
        );
    }
}
