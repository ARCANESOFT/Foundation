<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Auth;

use Arcanesoft\Foundation\Fortify\Concerns\HasPasswordBroker;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class     SendsPasswordResetLink
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait SendsPasswordResetLink
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasPasswordBroker;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array                     $credentials
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLink(Request $request, array $credentials)
    {
        $status = $this->broker()->sendResetLink($credentials);

        if ($status === PasswordBroker::RESET_LINK_SENT)
            return $this->getSuccessResponse($request, $status);

        return $this->getFailedResponse($request, $status);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  string                    $status
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function getSuccessResponse(Request $request, string $status)
    {
        $status = trans($status);

        if ($request->wantsJson())
            return new JsonResponse(['message' => trans($status)], JsonResponse::HTTP_OK);

        return redirect()
            ->back()
            ->with('status', trans($status));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param   string                   $status
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function getFailedResponse(Request $request, string $status)
    {
        $status = trans($status);

        if ($request->wantsJson())
            throw ValidationException::withMessages([
                'email' => $status,
            ]);

        return redirect()
            ->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => $status]);
    }
}
