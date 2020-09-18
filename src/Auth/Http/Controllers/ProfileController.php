<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

use Arcanesoft\Foundation\Auth\Http\Requests\Profile\{UpdateAccountRequest, UpdatePasswordRequest};
use Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository;
use Arcanesoft\Foundation\Authentication\Concerns\UseAdministratorGuard;
use Arcanesoft\Foundation\Support\Traits\HasNotifications;
use Illuminate\Http\Request;

/**
 * Class     ProfileController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ProfileController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UseAdministratorGuard;
    use HasNotifications;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->addBreadcrumbRoute(__('Profile'), 'admin::auth.profile.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return $this->view('authorization.profile.index', [
            'user' => $request->user($this->getGuardName()),
        ]);
    }

    /**
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Profile\UpdateAccountRequest  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository       $repo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAccount(UpdateAccountRequest $request, AdministratorsRepository $repo)
    {
        $repo->updateOne(
            $request->user($this->getGuardName()),
            $request->validated()
        );

        $this->notifySuccess(
            __('Account updated'),
            __('Your account has been successfully updated !')
        );

        return redirect()->back();
    }

    /**
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Profile\UpdatePasswordRequest  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository        $repo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request, AdministratorsRepository $repo)
    {
        $repo->updatePassword(
            $request->user($this->getGuardName()),
            $request->get('password')
        );

        $this->notifySuccess(
            __('Password updated'),
            __('Your password has been successfully updated !')
        );

        return redirect()->back();
    }
}
