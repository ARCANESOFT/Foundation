<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Repositories;

use Arcanesoft\Foundation\Authorization\Auth;

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
