<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\Users\Concerns;

use Arcanesoft\Foundation\Authorization\Policies\UsersPolicy;
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
     * Check if the authenticated user is authorized.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    public function authorize(Request $request): bool
    {
        return UsersPolicy::canFromRequest($request, 'metrics');
    }
}
