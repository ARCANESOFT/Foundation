<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Metrics\Roles;

use Arcanedev\LaravelMetrics\Metrics\Value;
use Arcanesoft\Foundation\Auth\Repositories\RolesRepository;
use Illuminate\Http\Request;

/**
 * Class     TotalRoles
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TotalRoles extends Value
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the metric.
     *
     * @param  \Illuminate\Http\Request                                  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $repo
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed
     */
    public function calculate(Request $request, RolesRepository $repo)
    {
        return $this->count($repo->query());
    }
}
