<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\Trend;
use Arcanesoft\Foundation\Authorization\Metrics\Users\Concerns\CanAuthorize;
use Arcanesoft\Foundation\Authorization\Repositories\UsersRepository;
use Illuminate\Http\Request;

/**
 * Class     UsersPerDay
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersPerDay extends Trend
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
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request                                           $request
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\UsersRepository  $repo
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed
     */
    public function calculate(Request $request, UsersRepository $repo)
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
            14 => __(':days Days', ['days' => 15]),
            30 => __(':days Days', ['days' => 30]),
        ];
    }
}
