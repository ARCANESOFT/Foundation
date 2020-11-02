<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\Roles;

use Arcanedev\LaravelMetrics\Metrics\Partition;
use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\RolesRepository;
use Illuminate\Http\Request;

/**
 * Class     TotalUsersByRoles
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TotalUsersByRoles extends Partition
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the metric.
     *
     * @param  \Illuminate\Http\Request                                  $request
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository  $repo
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed
     */
    public function calculate(Request $request, RolesRepository $repo)
    {
        // Calculate roles with users count
        $result = $repo->withCount(['administrators'])->get()->filter(function ($role) {
            return $role->administrators_count > 0;
        })->pluck('administrators_count', 'name');

        return $this->result($result)->sort('desc');
    }

    /**
     * Check if the current user is authorized.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    public function authorize(Request $request)
    {
        return Auth::admin()->can(AdministratorsPolicy::ability('metrics'));
    }
}