<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Arcanesoft\Foundation\Authentication\Concerns\UseAdministratorGuard;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Http\Request;

/**
 * Class     EnsureIsAuthenticated
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EnsureIsAuthenticated implements AuthenticatesRequests
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UseAdministratorGuard;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

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
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->isAuthenticated($request);

        return $next($request);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the user is logged in.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function isAuthenticated(Request $request)
    {
        $guard = $this->getGuardName();

        abort_unless($this->auth->guard($guard)->check(), 404);

        $this->auth->shouldUse($guard);
    }
}
