<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\Administrators;

use Arcanedev\LaravelMetrics\Metrics\NullablePartition;
use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Policies\AdministratorsPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository;
use Illuminate\Http\Request;

/**
 * Class     ActivatedAdministrators
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ActivatedAdministrators extends NullablePartition
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request                                           $request
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository  $repo
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed
     */
    public function calculate(Request $request, AdministratorsRepository $repo)
    {
        return $this->count($repo->query(), 'activated_at')
            ->labels([
                0 => __('Deactivated'),
                1 => __('Activated'),
            ])
            ->colors([
                0 => '#6C757D',
                1 => '#28A745',
            ])
            ->sort('desc');
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
