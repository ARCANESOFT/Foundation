<?php namespace Arcanesoft\Foundation\Policies;

use Arcanesoft\Contracts\Auth\Models\User;

/**
 * Class     LogViewerPolicy
 *
 * @package  Arcanesoft\Foundation\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerPolicy
{
    public function dashboardPolicy(User $user)
    {
        return $user->may('foundation.logviewer.dashboard');
    }

    public function listPolicy(User $user)
    {
        return $user->may('foundation.logviewer.list');
    }

    public function showPolicy(User $user)
    {
        return $user->may('foundation.logviewer.show');
    }

    public function downloadPolicy(User $user)
    {
        return $user->may('foundation.logviewer.download');
    }

    public function deletePolicy(User $user)
    {
        return $user->may('foundation.logviewer.delete');
    }
}
