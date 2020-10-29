<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Auth;

use Arcanesoft\Foundation\Fortify\Concerns\HasPasswordBroker;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Class     ResetsPasswords
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait ResetsPasswords
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
     * Reset the password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array                     $credentials
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function resetPassword(Request $request, array $credentials)
    {
        $status = $this->broker()->reset($credentials, function ($user, $password) use ($request) {
            $this->updatePassword($user, $password);

            event(new PasswordReset($user));
        });

        if ($status === Password::PASSWORD_RESET)
            return $this->getSuccessResponse($request, $status);

        return $this->getFailedResponse($request, $status);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Update user's password.
     *
     * @param  mixed   $user
     * @param  string  $password
     */
    protected function updatePassword($user, string $password): void
    {
        $user->setRememberToken(Str::random(60));

        $user->fill(['password' => $password])->save();
    }

    /**
     * Get the success response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string                    $status
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function getSuccessResponse(Request $request, string $status)
    {
        $status = trans($status);

        if ($request->wantsJson())
            return new JsonResponse(['message' => $status], JsonResponse::HTTP_OK);

        return redirect()
            ->to($this->getRedirectUrl())
            ->with('status', $status);
    }

    /**
     * Get the redirect URL.
     *
     * @return string
     */
    abstract protected function getRedirectUrl(): string;

    /**
     * Get the failed response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string                    $status
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function getFailedResponse(Request $request, string $status)
    {
        $status = trans($status);

        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [$status],
            ]);
        }

        return redirect()
            ->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => $status]);
    }
}
