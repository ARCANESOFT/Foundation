<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\Redirect;

/**
 * Class     EnsureEmailIsVerified
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EnsureEmailIsVerified
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
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $redirectToRoute = null)
    {
        if ( ! $this->mustBeVerified($request)) {
            return $next($request);
        }

        return $this->getMustBeVerifiedResponse(
            $request, $this->getRedirectRoute($redirectToRoute)
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the given user must be verified.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    protected function mustBeVerified(Request $request): bool
    {
        $user = $request->user();

        if (is_null($user))
            return false;

        if ( ! $user instanceof MustVerifyEmail)
            return false;

        return ! $user->hasVerifiedEmail();
    }

    /**
     * Get the "must be verified" response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null               $redirectToRoute
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function getMustBeVerifiedResponse(Request $request, string $redirectToRoute)
    {
        if ($request->expectsJson())
            abort(Response::HTTP_FORBIDDEN, 'Your email address is not verified.');

        return Redirect::route($redirectToRoute);
    }

    /**
     * Get the redirect route.
     *
     * @param  string|null  $redirectToRoute
     *
     * @return mixed|string
     */
    protected function getRedirectRoute(?string $redirectToRoute)
    {
        return $redirectToRoute ?: 'auth::email.verification.notice';
    }
}
