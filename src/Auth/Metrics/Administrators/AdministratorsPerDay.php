<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Metrics\Administrators;

use Arcanedev\LaravelMetrics\Metrics\Trend;
use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy;
use Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository;
use Illuminate\Http\Request;

/**
 * Class     AdministratorsPerDay
 *
 * @package  Arcanesoft\Foundation\Auth\Metrics\Administrators
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdministratorsPerDay extends Trend
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request                                           $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository  $repo
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed
     */
    public function calculate(Request $request, AdministratorsRepository $repo)
    {
        return $this->countByDays($repo->query());
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            7  => __(':days Days', ['days' => 7]),
            14 => __(':days Days', ['days' => 14]),
            30 => __(':days Days', ['days' => 30]),
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
        return Auth::admin()->can(AdministratorsPolicy::ability('metrics'));
    }
}