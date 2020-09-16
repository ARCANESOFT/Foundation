<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

use Arcanesoft\Foundation\Auth\Http\Requests\Roles\{CreateRoleRequest, UpdateRoleRequest};
use Arcanesoft\Foundation\Auth\Models\Role;
use Arcanesoft\Foundation\Auth\Policies\RolesPolicy;
use Illuminate\Http\Request;
use Arcanesoft\Foundation\Auth\Repositories\{PermissionsRepository, RolesRepository};
use Arcanesoft\Foundation\Support\Traits\HasNotifications;

/**
 * Class     RolesController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesController extends Controller
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

        $this->setCurrentSidebarItem('auth::authorization.roles');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Roles'), 'admin::auth.roles.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * List all the roles.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->authorize(RolesPolicy::ability('index'));

        return $this->view('authorization.roles.index');
    }

    /**
     * Show all the metrics.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function metrics()
    {
        $this->authorize(RolesPolicy::ability('metrics'));

        $this->addBreadcrumbRoute(__('Metrics'), 'admin::auth.roles.metrics');

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.authorization.roles');

        return $this->view('authorization.roles.metrics');
    }

    /**
     * Show the create role form.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\PermissionsRepository  $permissionsRepo
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(PermissionsRepository $permissionsRepo)
    {
        $this->authorize(RolesPolicy::ability('create'));

        $this->addBreadcrumb(__('Create Role'));

        $permissions = $permissionsRepo->with(['group'])->get();

        return $this->view('authorization.roles.create', compact('permissions'));
    }

    /**
     * Persist the new role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Roles\CreateRoleRequest  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository           $rolesRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRoleRequest $request, RolesRepository $rolesRepo)
    {
        $this->authorize(RolesPolicy::ability('create'));

        $data = $request->getValidatedData();
        $role = $rolesRepo->createOne($data);

        return redirect()->route('admin::auth.roles.show', [$role]);
    }

    /**
     * Show the role's details.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     * @param  \Illuminate\Http\Request                 $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Role $role, Request $request)
    {
        $this->authorize(RolesPolicy::ability('show'), [$role]);

        $tab = (string) $request->query('tab', 'administrators');

        abort_unless(in_array($tab, ['administrators', 'permissions']), 404);

        $role->load(['administrators', 'permissions.group']);

        $this->addBreadcrumbRoute($role->name, 'admin::auth.roles.show', [$role]);

        return $this->view('authorization.roles.show', compact('role', 'tab'));
    }

    /**
     * Edit the role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role                         $role
     * @param  \Arcanesoft\Foundation\Auth\Repositories\PermissionsRepository  $permissionsRepo
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Role $role, PermissionsRepository $permissionsRepo)
    {
        $this->authorize(RolesPolicy::ability('update'));

        $this->addBreadcrumb(__('Edit Role'));

        $role->load(['permissions']);

        $permissions = $permissionsRepo->with(['group'])->get();

        return $this->view('authorization.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role                            $role
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Roles\UpdateRoleRequest  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository           $rolesRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Role $role, UpdateRoleRequest $request, RolesRepository $rolesRepo)
    {
        $this->authorize(RolesPolicy::ability('update'));

        $data = $request->getValidatedData();
        $rolesRepo->updateOne($role, $data);

        if (empty($permissions = $data['permissions'] ?: []))
            $rolesRepo->detachAllPermissions($role);
        else
            $rolesRepo->syncPermissionsByUuids($role, $permissions);

        return redirect()->route('admin::auth.roles.show', [$role]);
    }

    /**
     * Activate/Deactivate the role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role                   $role
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $rolesRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(Role $role, RolesRepository $rolesRepo)
    {
        $this->authorize(RolesPolicy::ability('activate'), [$role]);

        $rolesRepo->toggleActive($role);

        $this->notifySuccess(
            __($role->isActive() ? 'Role Activated' : 'Role Deactivated'),
            __($role->isActive() ? 'The role has been successfully activated!' : 'The role has been successfully deactivated!')
        );

        return $this->jsonResponseSuccess();
    }

    /**
     * Delete a role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role                   $role
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $rolesRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Role $role, RolesRepository $rolesRepo)
    {
        $this->authorize(RolesPolicy::ability('delete'), [$role]);

        $rolesRepo->deleteOne($role);

        return $this->jsonResponseSuccess();
    }
}
