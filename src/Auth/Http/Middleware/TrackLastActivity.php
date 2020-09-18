<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class     TrackLastActivity
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TrackLastActivity
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
     * @param  string|null               $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check())
            Auth::guard($guard)->user()->updateLastActivity();

        return $next($request);
    }
}
