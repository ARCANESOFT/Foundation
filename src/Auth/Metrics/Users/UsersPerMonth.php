<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\Trend;
use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Policies\UsersPolicy;
use Arcanesoft\Foundation\Auth\Repositories\UsersRepository;
use Illuminate\Http\Request;

/**
 * Class     UsersPerMonth
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersPerMonth extends Trend
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
        return $this->countByMonths($repo->query());
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            3  => __(':months Months', ['months' => 3]),
            6  => __(':months Months', ['months' => 6]),
            9  => __(':months Months', ['months' => 9]),
            12 => __(':months Months', ['months' => 12]),
        ];
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
