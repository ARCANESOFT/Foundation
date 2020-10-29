<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Auth;

use Arcanesoft\Foundation\Authorization\Repositories\Authentication\TwoFactorAuthenticationRepository;
use Arcanesoft\Foundation\Fortify\Concerns\HasGuard;
use Arcanesoft\Foundation\Fortify\Http\Requests\TwoFactorLoginRequest;
use Illuminate\Http\{Request, Response};
use Illuminate\Validation\ValidationException;

/**
 * Trait     AuthenticatesWithTwoFactorChallenge
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait AuthenticatesWithTwoFactorChallenge
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
     * Show the two factor form.
     *
     * @param  string                         $view
     * @param  \Illuminate\Http\Request|null  $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    protected function form(string $view, Request $request = null)
    {
        if (is_null($request))
            $request = request();

        if (is_null($request->session()->get('login.id')))
            return redirect()->to(
                $this->getFailedTwoFactorRedirectUrl($request)
            );

        $request->session()->reflash();

        return view()->make($view);
    }

    /*
     * Attempt to authenticate a new session using the two factor authentication code.
     *
     * @param  \Arcanesoft\Foundation\Fortify\Http\Requests\TwoFactorLoginRequest|mixed  $request
     *
     * @return mixed
     */
    protected function login(TwoFactorLoginRequest $request)
    {
        $user = $request->challengedUser();

        if (is_null($user)) {
            return $this->getFailedTwoFactorLoginResponse($request);
        }

        if ($code = $request->validRecoveryCode()) {
            $this->getTwoFactorAuthenticationRepository()
                ->replaceRecoveryCode($user, $code);
        }
        elseif ( ! $request->hasValidCode()) {
            return $this->getFailedTwoFactorLoginResponse($request);
        }

        $this->guard()->login($user, $request->remember());

        return $this->getTwoFactorLoginResponse($request, $user);
    }

    /**
     * Get the two factor success response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $user
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getTwoFactorLoginResponse(Request $request, $user)
    {
        if ($request->wantsJson())
            return new Response('', Response::HTTP_NO_CONTENT);

        return redirect()->to($this->getRedirectUrlAfterLogin($request, $user));
    }

    /**
     * Get the failed two factor response.
     *
     * @param  \Illuminate\Http\Request|mixed  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function getFailedTwoFactorLoginResponse(Request $request)
    {
        $message = __('The provided two factor authentication code was invalid.');

        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'code' => [$message],
            ]);
        }

        return redirect()
            ->to($this->getFailedTwoFactorRedirectUrl($request))
            ->withErrors(['email' => $message]);
    }

    /**
     * Get the two factor's redirect url after login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $user
     *
     * @return string
     */
    abstract protected function getRedirectUrlAfterLogin(Request $request, $user): string;

    /**
     * Get the failed two factor's redirect url.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    abstract protected function getFailedTwoFactorRedirectUrl(Request $request): string;

    /**
     * Get the two factor authentication repository.
     *
     * @return \Arcanesoft\Foundation\Authorization\Repositories\Authentication\TwoFactorAuthenticationRepository
     */
    protected function getTwoFactorAuthenticationRepository()
    {
        return app(TwoFactorAuthenticationRepository::class);
    }
}
