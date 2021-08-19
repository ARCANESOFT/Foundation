<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\{RedirectResponse, Request};

/**
 * Trait     VerifiesEmails
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait VerifiesEmails
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function verifyEmail(Request $request)
    {
        $user = $this->getUserFromRequest($request);

        if ($user->hasVerifiedEmail()) {
            return $this->redirectTo($request, ['verified' => '1']);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $this->redirectTo($request, ['verified' => '1']);
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
