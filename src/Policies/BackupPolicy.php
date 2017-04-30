<?php namespace Arcanesoft\Foundation\Policies;

use Arcanesoft\Contracts\Auth\Models\User;

/**
 * Class     BackupPolicy
 *
 * @package  Arcanesoft\Foundation\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BackupPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const PERMISSION_LIST     = 'foundation.backups.list';
    const PERMISSION_SHOW     = 'foundation.backups.show';
    const PERMISSION_CREATE   = 'foundation.backups.create';
    const PERMISSION_DELETE   = 'foundation.backups.delete';

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the backups.
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
     * Allow to display a backup.
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
     * Allow to create a backup.
     *
     * @param  \Arcanesoft\Contracts\Auth\Models\User  $user
     *
     * @return bool
     */
    public function createPolicy(User $user)
    {
        return $user->may(static::PERMISSION_CREATE);
    }

    /**
     * Allow to delete a backup.
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
