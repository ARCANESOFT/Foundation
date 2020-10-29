<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Http\Controllers;

use Arcanesoft\Foundation\Authentication\Http\Requests\ResetPasswordRequest;
use Arcanesoft\Foundation\Authentication\Http\Routes\LoginRoutes;
use Arcanesoft\Foundation\Fortify\Auth\ResetsPasswords;
use Illuminate\Http\Request;

/**
 * Class     ResetPasswordController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ResetPasswordController
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use ResetsPasswords;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Show the new password view.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return view()->make('foundation::authentication.passwords.reset', [
            'token' => $request->route('token'),
            'email' => $request->input('email'),
        ]);
    }

    /**
     * Reset the user's password.
     *
     * @param  \Arcanesoft\Foundation\Authentication\Http\Requests\ResetPasswordRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(ResetPasswordRequest $request)
    {
        return $this->resetPassword($request, $request->validated());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the password broker's driver.
     *
     * @return string|null
     */
    protected static function getBrokerDriver(): string
    {
        return 'administrators';
    }

    /**
     * Get the redirect URL.
     *
     * @return string
     */
    protected function getRedirectUrl(): string
    {
        return route(LoginRoutes::LOGIN_CREATE);
    }
}
