<?php namespace Arcanesoft\Foundation\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class     AuthorizationServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthorizationServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //
    ];

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
        $gate->before(function ($user, $ability) {
            /** @var  \Arcanesoft\Auth\Models\User  $user */
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
        // TODO: Complete the log-viewer policy implementations.
        $gate->define('foundation.logviewer.dashboard', function ($user) {
            return true;
        });

        $gate->define('foundation.logviewer.list', function ($user) {
            return true;
        });

        $gate->define('foundation.logviewer.show', function ($user) {
            return true;
        });

        $gate->define('foundation.logviewer.download', function ($user) {
            return true;
        });

        $gate->define('foundation.logviewer.delete', function ($user) {
            return true;
        });
    }
}
