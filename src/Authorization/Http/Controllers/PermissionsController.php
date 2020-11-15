<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Controllers;

use Arcanesoft\Foundation\Authorization\Http\Datatables\PermissionsDatatable;
use Arcanesoft\Foundation\Authorization\Models\Permission;
use Arcanesoft\Foundation\Authorization\Policies\PermissionsPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\PermissionsRepository;
use Illuminate\Http\Request;

/**
 * Class     PermissionsController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('foundation::authorization.permissions');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Permissions'), 'admin::authorization.permissions.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(PermissionsPolicy::ability('index'));

        return $this->view('authorization.permissions.index');
    }

    public function datatable(PermissionsDatatable $datatable)
    {
        $this->authorize(PermissionsPolicy::ability('index'));

        return $datatable;
    }

    public function show(Permission $permission, PermissionsRepository $repo, Request $request)
    {
        $this->authorize(PermissionsPolicy::ability('show'));

        $roles = $repo->getFilteredRolesByAuthenticatedAdministrator($permission, $request->user());

        $this->addBreadcrumbRoute(__("Permission's details"), 'admin::authorization.permissions.show', [$permission]);

        return $this->view('authorization.permissions.show', compact('permission', 'roles'));
    }
}
