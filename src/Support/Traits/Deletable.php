<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Traits;

/**
 * Trait     Deletable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait Deletable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the object is deletable.
     *
     * @return bool
     */
    abstract public function isDeletable(): bool;

    /**
     * Check if the author is not deletable.
     *
     * @return bool
     */
    public function isNotDeletable(): bool
    {
        return ! $this->isDeletable();
    }
}
