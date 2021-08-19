<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\Trend;
use Arcanesoft\Foundation\Authorization\Metrics\Users\Concerns\CanAuthorize;
use Arcanesoft\Foundation\Authorization\Repositories\UsersRepository;
use Illuminate\Http\Request;

/**
 * Class     UsersPerWeek
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersPerWeek extends Trend
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
        return $this->countByWeeks($repo->query());
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            3  => '3 Weeks',
            6  => '6 Weeks',
            9  => '9 Weeks',
            12 => '12 Weeks',
        ];
    }
}
