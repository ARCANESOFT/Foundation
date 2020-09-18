<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Http\Controllers;

use Arcanesoft\Foundation\Fortify\Concerns\HasGuard;
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Pipeline\Pipeline;

/**
 * Class     LoginController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class LoginController
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
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array                     $actions
     *
     * @return mixed
     */
    protected function login(Request $request, array $actions)
    {
        return (new Pipeline(app()))
            ->send($request)
            ->through($actions)
            ->then(function ($request) {
                return $this->getLoginResponse($request);
            });
    }

    /**
     * Logout the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    protected function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->getLogoutResponse($request);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the login response after a successful authentication.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function getLoginResponse(Request $request)
    {
        if ($request->wantsJson()) {
            return new JsonResponse(
                ['two_factor' => false], JsonResponse::HTTP_OK
            );
        }

        return redirect()->intended($this->redirectUrlAfterLogin($request));
    }

    /**
     * Get the logout response after a successful authentication.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected function getLogoutResponse(Request $request)
    {
        $url = $this->redirectUrlAfterLogout($request);

        if ($request->wantsJson())
            return new Response(['redirect' => $url]);

        return redirect()->to($url);
    }

    /**
     * Get the redirect url after user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    abstract protected function redirectUrlAfterLogin(Request $request): string;

    /**
     * Get the redirect url after user was logout.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    abstract protected function redirectUrlAfterLogout(Request $request): string;
}
