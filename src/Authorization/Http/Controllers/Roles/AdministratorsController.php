<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Controllers\Roles;

use Arcanesoft\Foundation\Authorization\Http\Controllers\Controller;
use Arcanesoft\Foundation\Authorization\Models\{Administrator, Role};
use Arcanesoft\Foundation\Authorization\Policies\RolesPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\RolesRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class     AdministratorsController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdministratorsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Detach the administrator from the given role.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role                   $role
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator          $administrator
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository  $repo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function detach(Role $role, Administrator $administrator, RolesRepository $repo): JsonResponse
    {
        $this->authorize(RolesPolicy::ability('users.detach'), [$role, $administrator]);

        $repo->detachAdministrator($role, $administrator);

        // TODO: Add notification

        return static::jsonResponseSuccess();
    }
}
