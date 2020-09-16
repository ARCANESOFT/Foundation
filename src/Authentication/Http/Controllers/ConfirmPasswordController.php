<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Http\Controllers;

use Arcanesoft\Foundation\Authentication\Concerns\UseAdministratorGuard;
use Arcanesoft\Foundation\Core\Http\Routes\Web\DashboardRoutes;
use Arcanesoft\Foundation\Fortify\Http\Controllers\ConfirmPasswordController as Controller;
use Illuminate\Http\Request;

/**
 * Class     ConfirmPasswordController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ConfirmPasswordController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UseAdministratorGuard;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Show the confirm password view.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('foundation::auth.passwords.confirm');
    }

    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        return $this->confirm($request);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the redirect URL.
     *
     * @return string
     */
    protected function getRedirectUrl(): string
    {
        return route(DashboardRoutes::INDEX);
    }
}
