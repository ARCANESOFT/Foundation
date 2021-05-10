<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Http\Limiters;

use Arcanesoft\Foundation\Authorization\Auth;

/**
 * Class     LoginRateLimiter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LoginRateLimiter extends RateLimiter
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

        return 'throttle:'.Auth::config('limiters.login.throttle');
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
