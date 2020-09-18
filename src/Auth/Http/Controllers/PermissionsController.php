<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

use Arcanesoft\Foundation\Auth\Models\Permission;
use Arcanesoft\Foundation\Auth\Policies\PermissionsPolicy;
use Arcanesoft\Foundation\Auth\Repositories\PermissionsRepository;
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

        $this->setCurrentSidebarItem('auth::authorization.permissions');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Permissions'), 'admin::auth.permissions.index');
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

    public function show(Permission $permission, PermissionsRepository $repo, Request $request)
    {
        $this->authorize(PermissionsPolicy::ability('show'));

        $roles = $repo->getFilteredRolesByAuthenticatedAdministrator($permission, $request->user());

        $this->addBreadcrumbRoute(__("Permission's details"), 'admin::auth.permissions.show', [$permission]);

        return $this->view('authorization.permissions.show', compact('permission', 'roles'));
    }
}
