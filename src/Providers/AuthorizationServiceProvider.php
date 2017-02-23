<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\Providers\AuthorizationServiceProvider as ServiceProvider;
use Arcanesoft\Foundation\Policies\LogViewerPolicy;

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

        /** @var  \Illuminate\Auth\Access\Gate  $gate */
//        Gate::before(function (User $user, $ability) {
//            return $user->isAdmin() ? true : null;
//        });

        // TODO: Add more policies for other foundation features.

        $this->defineMany(LogViewerPolicy::class, LogViewerPolicy::policies());
    }
}
