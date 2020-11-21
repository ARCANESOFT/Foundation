<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\Roles\Concerns;

use Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy;
use Illuminate\Http\Request;

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
     * Check if the current user is authorized.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    public function authorize(Request $request): bool
    {
        return AdministratorsPolicy::canFromRequest($request, 'metrics');
    }
}
