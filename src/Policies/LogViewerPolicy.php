<?php namespace Arcanesoft\Foundation\Policies;

use Arcanesoft\Contracts\Auth\Models\User;

/**
 * Class     LogViewerPolicy
 *
 * @package  Arcanesoft\Foundation\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const PERMISSION_DASHBOARD = 'foundation.logviewer.dashboard';
    const PERMISSION_LIST      = 'foundation.logviewer.list';
    const PERMISSION_SHOW      = 'foundation.logviewer.show';
    const PERMISSION_DOWNLOAD  = 'foundation.logviewer.download';
    const PERMISSION_DELETE    = 'foundation.logviewer.delete';

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
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
        return $user->may(static::PERMISSION_DASHBOARD);
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
        return $user->may(static::PERMISSION_LIST);
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
        return $user->may(static::PERMISSION_SHOW);
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
        return $user->may(static::PERMISSION_DOWNLOAD);
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
        return $user->may(static::PERMISSION_DELETE);
    }
}
