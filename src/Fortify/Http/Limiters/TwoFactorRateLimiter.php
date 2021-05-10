<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Http\Limiters;

use Arcanesoft\Foundation\Authorization\Auth;

/**
 * Class     TwoFactorRateLimiter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TwoFactorRateLimiter extends RateLimiter
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the 'throttle' middleware.
     *
     * @return string|null
     */
    public static function middleware(): ?string
    {
        if ( ! static::isEnabled())
            return null;

        return 'throttle:'.Auth::config('limiters.two-factor.throttle');
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the throttle is enabled.
     *
     * @return bool
     */
    public static function isEnabled(): bool
    {
        return (bool) Auth::config('limiters.login.enabled');
    }
}
