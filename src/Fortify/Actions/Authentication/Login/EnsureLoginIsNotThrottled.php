<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Actions\Authentication\Login;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Fortify\Http\Limiters\LoginRateLimiter;
use Closure;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\{Request, Response};
use Illuminate\Validation\ValidationException;

/**
 * Class     EnsureLoginIsNotThrottled
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class EnsureLoginIsNotThrottled
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
     * EnsureLoginIsNotThrottled constructor.
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
     * @param  Closure                   $next
     *
     * @return mixed
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handle(Request $request, Closure $next)
    {
        if ( ! $this->limiter->isEnabled())
            return $next($request);

        if ( ! $this->limiter->tooManyAttempts($request))
            return $next($request);

        event(new Lockout($request));

        $seconds = $this->limiter->availableIn($request);

        throw ValidationException::withMessages([
            Auth::username() => [
                trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }
}
