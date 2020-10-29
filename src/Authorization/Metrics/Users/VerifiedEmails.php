<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\NullablePartition;
use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Policies\UsersPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\UsersRepository;
use Illuminate\Http\Request;

/**
 * Class     VerifiedEmails
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class VerifiedEmails extends NullablePartition
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request                                  $request
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\UsersRepository  $repo
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed
     */
    public function calculate(Request $request, UsersRepository $repo)
    {
        return $this->count($repo->query(), 'email_verified_at')
                    ->labels([
                        0 => __('Not verified'),
                        1 => __('Verified'),
                    ])
                    ->colors([
                        0 => '#6C757D',
                        1 => '#007BFF',
                    ])
                    ->sort('desc');
    }

    /**
     * Check if the authenticated user is authorized.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    public function authorize(Request $request)
    {
        return Auth::admin()->can(UsersPolicy::ability('metrics'));
    }
}
