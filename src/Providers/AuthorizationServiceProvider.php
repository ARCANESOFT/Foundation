<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\Providers\AuthorizationServiceProvider as ServiceProvider;
use Arcanesoft\Contracts\Auth\Models\User;
use Arcanesoft\Foundation\Policies;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

/**
 * Class     AuthorizationServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthorizationServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        /** @var  \Illuminate\Auth\Access\Gate  $gate */
        $gate->before(function (User $user, $ability) {
            return $user->isAdmin() ? true : null;
        });

        $this->registerLogViewerPolicies($gate);
    }

    /**
     * Register LogViewer policies.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     */
    private function registerLogViewerPolicies(GateContract $gate)
    {
        $this->defineMany(
            $gate,
            Policies\LogViewerPolicy::class,
            Policies\LogViewerPolicy::getPolicies()
        );
    }
}
