<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Models\Concerns;

use Illuminate\Support\Facades\Hash;

/**
 * Trait     HasPassword
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  string|null  password
 */
trait HasPassword
{
    /* -----------------------------------------------------------------
     |  Accessors & Mutators
     | -----------------------------------------------------------------
     */

    /**
     * Set the `password` attribute.
     *
     * @param  string|null  $password
     */
    public function setPasswordAttribute($password)
    {
        if (is_null($password))
            return;

        $this->attributes['password'] = Hash::make($password);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the user has password.
     *
     * @return bool
     */
    public function hasPassword(): bool
    {
        return ! is_null($this->password);
    }
}
