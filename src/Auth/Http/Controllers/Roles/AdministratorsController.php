<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Roles;

use Arcanesoft\Foundation\Auth\Http\Controllers\Controller;
use Arcanesoft\Foundation\Auth\Models\{Administrator, Role};
use Arcanesoft\Foundation\Auth\Policies\RolesPolicy;
use Arcanesoft\Foundation\Auth\Repositories\RolesRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class     AdministratorsController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Roles
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
     * @param  \Arcanesoft\Foundation\Auth\Models\Role                   $role
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator          $administrator
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $repo
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
