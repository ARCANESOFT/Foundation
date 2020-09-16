<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Concerns;

use Arcanesoft\Foundation\Authentication\Guard;

/**
 * Trait     UseUserGuard
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait UseUserGuard
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the guard name.
     *
     * @return string
     */
    protected function getGuardName(): string
    {
        return Guard::WEB_USER;
    }
}
