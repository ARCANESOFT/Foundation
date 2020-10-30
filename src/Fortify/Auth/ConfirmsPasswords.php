<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Auth;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Fortify\Concerns\HasGuard;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Validation\ValidationException;

/**
 * Trait     ConfirmsPasswords
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait ConfirmsPasswords
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasGuard;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Confirm the user's password
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function confirm(Request $request)
    {
        $confirmed = $this->confirmCredentials($request);

        if ( ! $confirmed)
            return $this->getFailedResponse($request);

        $request->session()->put('auth.password_confirmed_at', time());

        return $this->getSuccessResponse($request);
    }

    /**
     * Get the password confirmation status.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request)
    {
        $confirmed = (time() - $request->session()->get('auth.password_confirmed_at', 0)) < $request->input('seconds', config('auth.password_timeout', 900));

        return new JsonResponse(compact('confirmed'), JsonResponse::HTTP_OK);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Confirm the user's credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    protected function confirmCredentials(Request $request)
    {
        return $this->guard()->validate(
            $this->getCredentials($request)
        );
    }

    /**
     * Get user's credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    protected function getCredentials(Request $request): array
    {
        $user     = $request->user($this->getGuardName());
        $username = Auth::username();
        $password = $request->input('password');

        return [
            $username  => $user->{$username},
            'password' => $password,
        ];
    }

    /**
     * Get the success response.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function getSuccessResponse(Request $request)
    {
        if ($request->wantsJson()) {
            return new JsonResponse('', JsonResponse::HTTP_CREATED);
        }

        return redirect()->intended($this->getRedirectUrl());
    }

    /**
     * Get the failed response.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function getFailedResponse(Request $request)
    {
        $message = __('The provided password was incorrect.');

        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'password' => [$message],
            ]);
        }

        return redirect()->back()->withErrors(['password' => $message]);
    }

    /* -----------------------------------------------------------------
     |  Contractual Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the redirect URL.
     *
     * @return string
     */
    abstract protected function getRedirectUrl(): string;
}
