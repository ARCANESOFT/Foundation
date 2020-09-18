<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Actions\Authentication\Login;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Fortify\Concerns\HasGuard;
use Arcanesoft\Foundation\Fortify\LoginRateLimiter;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class     AttemptToAuthenticate
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AttemptToAuthenticate
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasGuard;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The login rate limiter instance.
     *
     * @var \Arcanesoft\Foundation\Fortify\LoginRateLimiter
     */
    protected $limiter;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AttemptToAuthenticate constructor.
     *
     * @param  \Arcanesoft\Foundation\Fortify\LoginRateLimiter  $limiter
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
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handle(Request $request, Closure $next)
    {
        $authenticated = $this->guard()->attempt(
            $request->only(Auth::username(), 'password'),
            $request->filled('remember')
        );

        if ( ! $authenticated) {
            $this->limiter->increment($request);

            throw ValidationException::withMessages([
                Auth::username() => [trans('auth.failed')],
            ]);
        }

        return $next($request);
    }
}
