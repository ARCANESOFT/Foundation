<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Arcanesoft\Foundation\Authorization\Contracts\CanBeActivated;
use Closure;
use Illuminate\Http\{Request, Response};

/**
 * Class     EnsureIsActive
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EnsureIsActive
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        abort_unless($this->isActivated($user), Response::HTTP_FORBIDDEN);

        return $next($request);
    }

    /**
     * Check if the given user has an `active` account.
     *
     * @param  mixed  $user
     *
     * @return bool
     */
    private function isActivated($user): bool
    {
        if ( ! $user instanceof CanBeActivated)
            return false;

        return $user->isActive();
    }
}
