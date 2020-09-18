<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Contracts;

/**
 * Interface  CanBeActivated
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface CanBeActivated
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the model is active.
     *
     * @return bool
     */
    public function isActive(): bool;
}
