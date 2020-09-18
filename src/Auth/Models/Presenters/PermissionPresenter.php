<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models\Presenters;

use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Trait     PermissionPresenter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  \Illuminate\Database\Eloquent\Collection  roles
 *
 * @property-read  int  users_count
 */
trait PermissionPresenter
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the `users_count` attribute.
     *
     * @return int
     */
    public function getUsersCountAttribute(): int
    {
        return $this->roles->sum(function (Role $role) {
            return $role->administrators->count();
        });
    }
}
