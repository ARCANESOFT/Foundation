<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\PasswordResets\Concerns;

use Arcanesoft\Foundation\Authorization\Policies\PasswordResetsPolicy;
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
        return PasswordResetsPolicy::canFromRequest($request, 'metrics');
    }
}
