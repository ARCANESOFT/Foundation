<?php namespace Arcanesoft\Foundation\Policies;

use Arcanesoft\Contracts\Auth\Models\User;

/**
 * Class     LogViewerPolicy
 *
 * @package  Arcanesoft\Foundation\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @todo: Adding the check role (LogViewer manager role)
 */
class LogViewerPolicy
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters and Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the policies.
     *
     * @return array
     */
    public static function getPolicies()
    {
        return [
            'dashboardPolicy' => 'foundation.logviewer.dashboard',
            'listPolicy'      => 'foundation.logviewer.list',
            'showPolicy'      => 'foundation.logviewer.show',
            'downloadPolicy'  => 'foundation.logviewer.download',
            'deletePolicy'    => 'foundation.logviewer.delete',
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Policies Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Allow to view the LogViewer dashboard.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function dashboardPolicy(User $user)
    {
        return $user->may('foundation.logviewer.dashboard');
    }

    /**
     * Allow to list all the logs.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function listPolicy(User $user)
    {
        return $user->may('foundation.logviewer.list');
    }

    /**
     * Allow to display a log.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function showPolicy(User $user)
    {
        return $user->may('foundation.logviewer.show');
    }

    /**
     * Allow to download a log.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function downloadPolicy(User $user)
    {
        return $user->may('foundation.logviewer.download');
    }

    /**
     * Allow to delete a log.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function deletePolicy(User $user)
    {
        return $user->may('foundation.logviewer.delete');
    }
}
