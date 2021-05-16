<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Concerns;

use Illuminate\Http\Request;

/**
 * Trait     CanRetrieveUserFromRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait RetrievesUserFromRequest
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasGuard;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the authenticated user from request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \App\Models\User|mixed
     */
    protected function getUserFromRequest(Request $request)
    {
        return $request->user($this->getGuardName());
    }
}
