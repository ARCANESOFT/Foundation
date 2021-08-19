<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Controllers;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Http\Datatables\RolesDatatable;
use Arcanesoft\Foundation\Authorization\Http\Requests\Roles\{CreateRoleRequest, UpdateRoleRequest};
use Arcanesoft\Foundation\Authorization\Models\Role;
use Arcanesoft\Foundation\Authorization\Policies\RolesPolicy;
use Illuminate\Http\Request;
use Arcanesoft\Foundation\Authorization\Repositories\{PermissionsRepository, RolesRepository};
use Arcanesoft\Foundation\Support\Traits\HasNotifications;

/**
 * Class     RolesController
 *
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

        $this->setCurrentSidebarItem('foundation::authorization.roles');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Roles'), 'admin::authorization.roles.index');
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
     * Datatable api response.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Http\Datatables\RolesDatatable  $datatable
     *
     * @return \Arcanesoft\Foundation\Authorization\Http\Datatables\RolesDatatable
     */
    public function datatable(RolesDatatable $datatable)
    {
        $this->authorize(RolesPolicy::ability('index'));

        return $datatable;
    }

    /**
     * Show all the metrics.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function metrics()
    {
        $this->authorize(RolesPolicy::ability('metrics'));

        $this->addBreadcrumbRoute(__('Metrics'), 'admin::authorization.roles.metrics');

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.authorization.roles');

        return $this->view('authorization.roles.metrics');
    }

    /**
     * Show the create role form.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository  $permissionsRepo
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(PermissionsRepository $permissionsRepo)
    {
        $this->authorize(RolesPolicy::ability('create'));

        $this->addBreadcrumb(__('Create Role'));

        $permissions = $permissionsRepo->with(['group'])->get();
        $selectedPermissions = [];

        return $this->view(
            'authorization.roles.create',
            compact('permissions', 'selectedPermissions')
        );
    }

    /**
     * Persist the new role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Http\Requests\Roles\CreateRoleRequest  $request
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository           $rolesRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRoleRequest $request, RolesRepository $rolesRepo)
    {
        $this->authorize(RolesPolicy::ability('create'));
        
        $role = $rolesRepo->createOne($request->validated());

        static::notifySuccess(
            'Role Created',
            'The role has been successfully created!'
        );

        return redirect()->route('admin::authorization.roles.show', [$role]);
    }

    /**
     * Show the role's details.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role  $role
     * @param  \Illuminate\Http\Request                          $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Role $role, Request $request)
    {
        $this->authorize(RolesPolicy::ability('show'), [$role]);

        $tab = (string) $request->query('tab', 'administrators');

        abort_unless(in_array($tab, ['administrators', 'permissions']), 404);

        $role->load(['administrators', 'permissions.group']);

        $this->addBreadcrumbRoute($role->name, 'admin::authorization.roles.show', [$role]);

        return $this->view('authorization.roles.show', compact('role', 'tab'));
    }

    /**
     * Edit the role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role                         $role
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository  $permissionsRepo
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Role $role, PermissionsRepository $permissionsRepo)
    {
        $this->authorize(RolesPolicy::ability('update'), [$role]);

        $this->addBreadcrumb(__('Edit Role'));

        $role->load(['permissions']);

        $permissions = $permissionsRepo->with(['group'])->get();
        $selectedPermissions = $role->permissions
            ->pluck(Auth::makeModel('permission')->getRouteKeyName())
            ->toArray();

        return $this->view(
            'authorization.roles.edit',
            compact('role', 'permissions', 'selectedPermissions')
        );
    }

    /**
     * Update the role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role                            $role
     * @param  \Arcanesoft\Foundation\Authorization\Http\Requests\Roles\UpdateRoleRequest  $request
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository           $rolesRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Role $role, UpdateRoleRequest $request, RolesRepository $rolesRepo)
    {
        $this->authorize(RolesPolicy::ability('update'), [$role]);

        $rolesRepo->updateOneWithPermissions($role, $request->validated());

        static::notifySuccess(
            'Role Updated',
            'The role has been successfully updated!'
        );

        return redirect()->route('admin::authorization.roles.show', [$role]);
    }

    /**
     * Activate/Deactivate the role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role                   $role
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository  $rolesRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(Role $role, RolesRepository $rolesRepo)
    {
        $this->authorize(RolesPolicy::ability('activate'), [$role]);

        $rolesRepo->toggleActive($role);

        static::notifySuccess(
            'Role Activated',
            'The role has been successfully activated!'
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Deactivate the role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role                   $role
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository  $rolesRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivate(Role $role, RolesRepository $rolesRepo)
    {
        $this->authorize(RolesPolicy::ability('deactivate'), [$role]);

        $rolesRepo->deactivateOne($role);

        static::notifySuccess(
            'Role Deactivated',
            'The role has been successfully deactivated!'
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Delete a role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role                   $role
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository  $rolesRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Role $role, RolesRepository $rolesRepo)
    {
        $this->authorize(RolesPolicy::ability('delete'), [$role]);

        $rolesRepo->deleteOne($role);

        return static::jsonResponseSuccess();
    }
}
