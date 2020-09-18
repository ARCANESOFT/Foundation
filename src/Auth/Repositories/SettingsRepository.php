<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\Auth;

/**
 * Class     SettingsRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SettingsRepository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the authentication settings.
     *
     * @return array
     */
    public function getAuthenticationSettings(): array
    {
        return Auth::config('authentication', []);
    }
}
