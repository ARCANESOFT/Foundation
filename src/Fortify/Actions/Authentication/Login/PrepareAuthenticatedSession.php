<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Actions\Authentication\Login;

use Arcanesoft\Foundation\Fortify\Http\Limiters\LoginRateLimiter;
use Closure;
use Illuminate\Http\Request;

/**
 * Class     PrepareAuthenticatedSession
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class PrepareAuthenticatedSession
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The login rate limiter instance.
     *
     * @var \Arcanesoft\Foundation\Fortify\Http\Limiters\LoginRateLimiter
     */
    protected $limiter;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * PrepareAuthenticatedSession constructor.
     *
     * @param  \Arcanesoft\Foundation\Fortify\Http\Limiters\LoginRateLimiter  $limiter
     */
    public function __construct(LoginRateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->session()->regenerate();

        $this->limiter->clear($request);

        return $next($request);
    }
}
