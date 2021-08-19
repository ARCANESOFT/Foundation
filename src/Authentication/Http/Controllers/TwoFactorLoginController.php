<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Http\Controllers;

use Arcanesoft\Foundation\Authentication\Concerns\UseAdministratorGuard;
use Arcanesoft\Foundation\Fortify\Auth\AuthenticatesWithTwoFactorChallenge;
use Illuminate\Http\Request;

/**
 * Class     TwoFactorLoginController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TwoFactorLoginController
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use AuthenticatesWithTwoFactorChallenge;
    use UseAdministratorGuard;

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the two factor's redirect url after login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $user
     *
     * @return string
     */
    protected function getRedirectUrlAfterLogin(Request $request, $user): string
    {
        // TODO: Implement getRedirectUrlAfterLogin() method.
    }

    /**
     * Get the failed two factor's redirect url.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    protected function getFailedTwoFactorRedirectUrl(Request $request): string
    {
        // TODO: Implement getFailedTwoFactorRedirectUrl() method.
    }
}
