<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Contracts\BrowserSessions;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface  HasBrowserSessions
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface HasBrowserSessions
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * The sessions' relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions(): HasMany;
}
