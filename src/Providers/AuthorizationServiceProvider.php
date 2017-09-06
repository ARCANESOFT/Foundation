<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\Providers\AuthorizationServiceProvider as ServiceProvider;
use Arcanesoft\Foundation\Policies\LogViewerPolicy;
use Arcanesoft\Foundation\Policies\RouteViewerPolicy;

/**
 * Class     AuthorizationServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthorizationServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any application authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->defineMany(LogViewerPolicy::class, LogViewerPolicy::policies());
        $this->defineMany(RouteViewerPolicy::class, RouteViewerPolicy::policies());

        // TODO: Add more policies for other foundation features.
    }
}
