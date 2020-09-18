<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Concerns;

use Illuminate\Auth\Access\AuthorizationException;

/**
 * Trait     CanAuthorize
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait CanAuthorize
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the request passes the authorization check.
     *
     * @return bool
     */
    protected function passesAuthorization(): bool
    {
        if (method_exists($this, 'authorize'))
            return app()->call([$this, 'authorize']);

        return true;
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization(): void
    {
        throw new AuthorizationException;
    }
}
