<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Http\Requests\Administrators\{CreateAdministratorRequest, UpdateAdministratorRequest};
use Arcanesoft\Foundation\Auth\Models\Administrator;
use Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy;
use Arcanesoft\Foundation\Auth\Repositories\{AdministratorsRepository, RolesRepository};
use Arcanesoft\Foundation\Support\Traits\HasNotifications;

/**
 * Class     AdministratorsController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdministratorsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasNotifications;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('auth::authorization.administrators');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Administrators'), 'admin::auth.administrators.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * List all the administrators.
     *
     * @param  bool  $trash
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index($trash = false)
    {
        $this->authorize(AdministratorsPolicy::ability('index'));

        return $this->view('authorization.administrators.index', compact('trash'));
    }

    /**
     * List all the deleted administrators.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function trash()
    {
        return $this->index(true);
    }

    /**
     * Show all the metrics.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function metrics()
    {
        $this->authorize(AdministratorsPolicy::ability('metrics'));

        $this->addBreadcrumbRoute(__('Metrics'), 'admin::auth.administrators.metrics');

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.authorization.administrators');

        return $this->view('authorization.administrators.metrics');
    }

    /**
     * Create a new administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $rolesRepo
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(RolesRepository $rolesRepo)
    {
        $this->authorize(AdministratorsPolicy::ability('create'));

        $roles = $rolesRepo->getFilteredByAuthenticatedAdministrator(Auth::admin());

        $this->addBreadcrumb(__('New Administrator'));

        return $this->view('authorization.administrators.create', compact('roles'));
    }

    /**
     * Persist the new administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Administrators\CreateAdministratorRequest  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository                    $repo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAdministratorRequest $request, AdministratorsRepository $repo)
    {
        $this->authorize(AdministratorsPolicy::ability('create'));

        $attributes = $request->validated();

        $attributes['roles'] = $attributes['roles'] ?? [];

        $admin = $repo->createOneWithRoles($attributes);

        static::notifySuccess(
            'Administrator Created',
            'A new administrator has been successfully created!'
        );

        return redirect()->route('admin::auth.administrators.show', [$admin]);
    }

    /**
     * Show the administrator's details.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Administrator $administrator)
    {
        $this->authorize(AdministratorsPolicy::ability('show'), [$administrator]);

        $this->addBreadcrumbRoute(
            __("Administrator's details"),
            'admin::auth.administrators.show', [$administrator]
        );

        return $this->view('authorization.administrators.show', compact('administrator'));
    }

    /**
     * Edit the administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator          $administrator
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $rolesRepo
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Administrator $administrator, RolesRepository $rolesRepo)
    {
        $this->authorize(AdministratorsPolicy::ability('update'), [$administrator]);

        $administrator->load(['roles']);

        $roles = $rolesRepo->getFilteredByAuthenticatedAdministrator(Auth::admin());

        $this->addBreadcrumbRoute(
            __('Edit Administrator'),
            'admin::auth.administrators.edit', [$administrator]
        );

        return $this->view('authorization.administrators.edit', compact('administrator', 'roles'));
    }

    /**
     * Update the administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator                                     $administrator
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Administrators\UpdateAdministratorRequest  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository                    $repo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Administrator $administrator, UpdateAdministratorRequest $request, AdministratorsRepository $repo)
    {
        $this->authorize(AdministratorsPolicy::ability('update'), [$administrator]);

        $attributes = $request->validated();

        $attributes['roles'] = $attributes['roles'] ?? [];

        $repo->updateOneWithRoles($administrator, $attributes);

        static::notifySuccess(
            'Administrator Updated',
            'The administrator has been successfully updated!'
        );

        return redirect()->route('admin::auth.administrators.show', [$administrator]);
    }

    /**
     * Activate an administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator                   $administrator
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository  $repo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(Administrator $administrator, AdministratorsRepository $repo)
    {
        $this->authorize(AdministratorsPolicy::ability('activate'), [$administrator]);

        $repo->activateOne($administrator);

        static::notifySuccess(
            'Administrator Activated',
            'The administrator has been successfully activated!'
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Deactivate an administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator                   $administrator
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository  $repo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivate(Administrator $administrator, AdministratorsRepository $repo)
    {
        $this->authorize(AdministratorsPolicy::ability('deactivate'), [$administrator]);

        $repo->deactivateOne($administrator);

        static::notifySuccess(
            'Administrator Deactivated',
            'The administrator has been successfully deactivated!'
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Delete an administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator                   $administrator
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository  $repo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Administrator $administrator, AdministratorsRepository $repo)
    {
        $this->authorize(
            AdministratorsPolicy::ability($administrator->trashed() ? 'force-delete' : 'delete'),
            [$administrator]
        );

        $repo->deleteOne($administrator);

        static::notifySuccess(
            'Administrator Deleted',
            'The administrator has been successfully deleted!'
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Restore a deleted administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator                   $administrator
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository  $repo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(Administrator $administrator, AdministratorsRepository $repo)
    {
        $this->authorize(AdministratorsPolicy::ability('restore'), [$administrator]);

        $repo->restoreOne($administrator);

        static::notifySuccess(
            'Administrator Restored',
            'The administrator has been successfully restored!'
        );

        return static::jsonResponseSuccess();
    }
}
