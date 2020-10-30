<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Auth;

use Arcanesoft\Foundation\Fortify\Concerns\RetrievesUserFromRequest;
use Closure;
use Illuminate\Http\{RedirectResponse, Request};

/**
 * Trait     PromptsEmailVerification
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait PromptsEmailVerification
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $callback
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    protected function promptEmailVerification(Request $request, Closure $callback)
    {
        $user = $this->getUserFromRequest($request);

        if ($user->hasVerifiedEmail()) {
            return $this->redirectTo($request);
        }

        return $callback($request);
    }

    /* -----------------------------------------------------------------
     |  Contractual Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the authenticated user from request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \App\Models\User|mixed
     */
    abstract protected function getUserFromRequest(Request $request);

    /**
     * Redirected to a specific page if verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array                     $parameters
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    abstract protected function redirectTo(Request $request, array $parameters = []): RedirectResponse;
}
