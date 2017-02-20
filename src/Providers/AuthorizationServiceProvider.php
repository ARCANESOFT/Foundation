<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\Providers\AuthorizationServiceProvider as ServiceProvider;
use Arcanesoft\Contracts\Auth\Models\User;
use Arcanesoft\Foundation\Policies;
use Illuminate\Support\Facades\Gate;

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
        Gate::before(function (User $user, $ability) {
            return $user->isAdmin() ? true : null;
        });

        $this->registerLogViewerPolicies();
    }

    /**
     * Register LogViewer policies.
     */
    private function registerLogViewerPolicies()
    {
        $this->defineMany(
            Policies\LogViewerPolicy::class,
            Policies\LogViewerPolicy::getPolicies()
        );
    }
}
