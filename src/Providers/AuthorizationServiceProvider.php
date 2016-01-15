<?php namespace Arcanesoft\Foundation\Providers;

use Arcanesoft\Contracts\Auth\Models\User;
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
        $class    = \Arcanesoft\Foundation\Policies\LogViewerPolicy::class;
        $policies = [
            'dashboardPolicy' => 'foundation.logviewer.dashboard',
            'listPolicy'      => 'foundation.logviewer.list',
            'showPolicy'      => 'foundation.logviewer.show',
            'downloadPolicy'  => 'foundation.logviewer.download',
            'deletePolicy'    => 'foundation.logviewer.delete',
        ];

        foreach ($policies as $method => $ability) {
            $gate->define($ability, "$class@$method");
        }
    }
}
