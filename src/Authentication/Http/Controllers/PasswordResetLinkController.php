<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Http\Controllers;

use Arcanesoft\Foundation\Authentication\Http\Requests\SendPasswordResetLinkRequest;
use Arcanesoft\Foundation\Fortify\Auth\SendsPasswordResetLink;
use Illuminate\Http\Request;

/**
 * Class     PasswordResetLinkController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetLinkController
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use SendsPasswordResetLink;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Show the reset password link request view.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view()->make('foundation::authentication.passwords.forgot');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Arcanesoft\Foundation\Authentication\Http\Requests\SendPasswordResetLinkRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(SendPasswordResetLinkRequest $request)
    {
        return $this->sendResetLink($request, $request->validated());
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
    protected static function getBrokerDriver(): ?string
    {
        return 'administrators';
    }
}
