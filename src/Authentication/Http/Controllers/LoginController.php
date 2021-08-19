<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Http\Controllers;

use Arcanesoft\Foundation\Fortify\Auth\AuthenticatesUsers;
use Arcanesoft\Foundation\Authentication\Actions\Login\AttemptToAuthenticate;
use Arcanesoft\Foundation\Authentication\Actions\Login\EnsureLoginIsNotThrottled;
use Arcanesoft\Foundation\Authentication\Actions\Login\PrepareAuthenticatedSession;
use Arcanesoft\Foundation\Authentication\Actions\Login\RedirectIfTwoFactorWasEnabled;
use Arcanesoft\Foundation\Authentication\Concerns\UseAdministratorGuard;
use Arcanesoft\Foundation\Authentication\Http\Requests\LoginRequest;
use Arcanesoft\Foundation\Core\Http\Routes\Web\DashboardRoutes;
use Illuminate\Http\Request;

/**
 * Class     LoginController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LoginController
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use AuthenticatesUsers;
    use UseAdministratorGuard;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view()->make('foundation::authentication.login');
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Arcanesoft\Foundation\Authentication\Http\Requests\LoginRequest  $request
     *
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->login($request, [
            EnsureLoginIsNotThrottled::class,
            RedirectIfTwoFactorWasEnabled::class,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->logout($request);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the redirect url after user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    protected function redirectUrlAfterLogin(Request $request): string
    {
        return route(DashboardRoutes::INDEX);
    }

    /**
     * Get the redirect url after user was logout.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    protected function redirectUrlAfterLogout(Request $request): string
    {
        return route('public::index');
    }
}
