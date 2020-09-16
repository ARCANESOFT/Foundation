<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify;

use Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthenticationProvider as TwoFactorAuthenticationProviderContract;
use Arcanesoft\Foundation\Fortify\Services\TwoFactorAuthentication\TwoFactorAuthenticationProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class     FortifyServiceProvider
 *
 * @package  Arcanesoft\Foundation\Fortify
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
            TwoFactorAuthenticationProviderContract::class,
            TwoFactorAuthenticationProvider::class
        );
    }
}
