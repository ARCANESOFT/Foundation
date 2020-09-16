<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

/**
 * Class     CheckForMaintenanceMode
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CheckForMaintenanceMode extends Middleware
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the URIs that should be accessible while maintenance mode is enabled.
     *
     * @return array
     */
    protected function exceptUris(): array
    {
        return array_merge(
            $this->except,
            config('arcanesoft.foundation.settings.maintenance.except.uris', [])
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the request has a URI that should be accessible in maintenance mode.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach ($this->exceptUris() as $except) {
            if ($except !== '/')
                $except = trim($except, '/');

            if ($request->fullUrlIs($except) || $request->is($except))
                return true;
        }

        return false;
    }
}
