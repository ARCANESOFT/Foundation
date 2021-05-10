<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Http\Limiters;

use Arcanesoft\Foundation\Authorization\Auth;
use Illuminate\Cache\RateLimiter as Limiter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class     RateLimiter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RateLimiter
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The login rate limiter instance.
     *
     * @var \Illuminate\Cache\RateLimiter
     */
    protected $limiter;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * LoginRateLimiter constructor.
     *
     * @param  \Illuminate\Cache\RateLimiter  $limiter
     */
    public function __construct(Limiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    public function tooManyAttempts(Request $request): bool
    {
        return $this->limiter->tooManyAttempts($this->throttleKey($request), 5);
    }

    /**
     * Increment the login attempts for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function increment(Request $request): void
    {
        $this->limiter->hit($this->throttleKey($request), 60);
    }

    /**
     * Determine the number of seconds until logging in is available again.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return int
     */
    public function availableIn(Request $request): int
    {
        return $this->limiter->availableIn($this->throttleKey($request));
    }

    /**
     * Clear the login locks for the given user credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function clear(Request $request): void
    {
        $this->limiter->clear($this->throttleKey($request));
    }

    /**
     * Get the number of attempts for the given key.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    public function attempts(Request $request)
    {
        return $this->limiter->attempts($this->throttleKey($request));
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the throttle key for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input(Auth::username())).'|'.$request->ip();
    }
}
