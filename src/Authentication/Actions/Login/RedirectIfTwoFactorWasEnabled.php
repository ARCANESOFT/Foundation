<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Actions\Login;

use Arcanesoft\Foundation\Authentication\Concerns\UseAdministratorGuard;
use Arcanesoft\Foundation\Fortify\Actions\Authentication\Login\RedirectIfTwoFactorWasEnabled as Action;
use Illuminate\Http\Request;

/**
 * Class     RedirectIfTwoFactorWasEnabled
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RedirectIfTwoFactorWasEnabled extends Action
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UseAdministratorGuard;

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the two factor redirect url.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    protected function getTwoFactorUrl(Request $request)
    {
        return route('auth::admin.login.two-factor.create');
    }
}
