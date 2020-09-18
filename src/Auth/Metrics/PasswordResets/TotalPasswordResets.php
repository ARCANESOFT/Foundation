<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Metrics\PasswordResets;

use Arcanedev\LaravelMetrics\Metrics\Value;
use Arcanesoft\Foundation\Auth\Policies\PasswordResetsPolicy;
use Arcanesoft\Foundation\Auth\Repositories\PasswordResetsRepository;
use Illuminate\Http\Request;

/**
 * Class     TotalPasswordResets
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TotalPasswordResets extends Value
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request                                           $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\PasswordResetsRepository  $repo
     *
     * @return mixed
     */
    public function calculate(Request $request, PasswordResetsRepository $repo)
    {
        return $this->result($repo->count());
    }

    /**
     * Check if the current user is authorized.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return bool
     */
    public function authorize(Request $request): bool
    {
        return $request->user()->can(PasswordResetsPolicy::ability('metrics'));
    }
}
