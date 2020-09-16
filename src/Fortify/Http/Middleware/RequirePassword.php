<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Http\Middleware;

use Closure;
use Illuminate\Http\{JsonResponse, Request};

/**
 * Class     RequirePassword
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RequirePassword
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
     * @param  string|null               $redirectToRoute
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ?string $redirectToRoute = null)
    {
        if ( ! $this->shouldConfirmPassword($request)) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return $this->getJsonResponse($request);
        }

        return redirect()->guest($this->getRedirectUrl($request, $redirectToRoute));
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the confirmation timeout has expired.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    protected function shouldConfirmPassword(Request $request): bool
    {
        if ( ! $this->hasPassword($request))
            return false;

        $confirmedAt = time() - $request->session()->get('auth.password_confirmed_at', 0);

        return $confirmedAt > $this->getPasswordTimeout();
    }

    /**
     * Check if the authenticated user has password.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    protected function hasPassword(Request $request): bool
    {
        return $this->getUserFromRequest($request)->hasPassword();
    }

    /**
     * Get the authenticated user from request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Models\User|mixed
     */
    protected function getUserFromRequest(Request $request)
    {
        return $request->user();
    }

    /**
     * Get password timeout.
     *
     * @return int
     */
    protected function getPasswordTimeout(): int
    {
        return config('auth.password_timeout', 10800);
    }

    /**
     * Get the redirect URL.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null               $redirectToRoute
     *
     * @return string
     */
    protected function getRedirectUrl(Request $request, ?string $redirectToRoute): string
    {
        return route($redirectToRoute ?? 'auth::password.confirm');
    }

    /**
     * Get the json response.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponse(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Password confirmation required.',
        ], JsonResponse::HTTP_LOCKED);
    }
}
