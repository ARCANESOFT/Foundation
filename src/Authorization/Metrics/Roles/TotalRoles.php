<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\Roles;

use Arcanedev\LaravelMetrics\Metrics\Value;
use Arcanesoft\Foundation\Authorization\Metrics\Roles\Concerns\CanAuthorize;
use Arcanesoft\Foundation\Authorization\Repositories\RolesRepository;
use Illuminate\Http\Request;

/**
 * Class     TotalRoles
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TotalRoles extends Value
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use CanAuthorize;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the metric.
     *
     * @param  \Illuminate\Http\Request                                           $request
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\RolesRepository  $repo
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed
     */
    public function calculate(Request $request, RolesRepository $repo)
    {
        return $this->count($repo->query());
    }
}
