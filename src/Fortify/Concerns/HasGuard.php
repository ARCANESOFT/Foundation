<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Concerns;

use Illuminate\Contracts\Auth\Factory as AuthContract;
use Illuminate\Contracts\Auth\StatefulGuard;

/**
 * Trait     HasGuard
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasGuard
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the auth factory instance.
     *
     * @param  string|null  $name
     *
     * @return \Illuminate\Auth\SessionGuard|mixed
     */
    protected function guard(string $name = null): StatefulGuard
    {
        return app(AuthContract::class)->guard($name ?: $this->getGuardName());
    }

    /**
     * Get the guard name.
     *
     * @return string
     */
    abstract protected function getGuardName(): string;
}
