<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\Value;
use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Policies\UsersPolicy;
use Arcanesoft\Foundation\Auth\Repositories\UsersRepository;
use Illuminate\Http\Request;

/**
 * Class     TotalUsers
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TotalUsers extends Value
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request                                  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\UsersRepository  $repo
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed
     */
    public function calculate(Request $request, UsersRepository $repo)
    {
        return $this->count($repo->query());
    }

    /**
     * Check if the authenticated user is authorized.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    public function authorize(Request $request): bool
    {
        return Auth::admin()->can(UsersPolicy::ability('metrics'));
    }
}
