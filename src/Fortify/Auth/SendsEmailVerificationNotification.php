<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Auth;

use Illuminate\Http\{JsonResponse, RedirectResponse, Request};

/**
 * Trait     SendsEmailVerificationNotification
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait SendsEmailVerificationNotification
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function sendEmailVerification(Request $request)
    {
        $user = $this->getUserFromRequest($request);

        if ($user->hasVerifiedEmail()) {
            return $this->getResendSkippedResponse($request);
        }

        $user->sendEmailVerificationNotification();

        return $this->getResendSuccessResponse($request);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the 'resend' success response.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function getResendSuccessResponse(Request $request)
    {
        if ($request->wantsJson()) {
            return new JsonResponse('', JsonResponse::HTTP_ACCEPTED);
        }

        return redirect()
            ->back()
            ->with('status', 'verification-link-sent');
    }

    /**
     * Get the 'skipped' success response.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function getResendSkippedResponse(Request $request)
    {
        if ($request->wantsJson()) {
            return new JsonResponse('', JsonResponse::HTTP_NO_CONTENT);
        }

        return $this->redirectTo($request);
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
