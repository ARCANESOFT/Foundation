<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\Trend;
use Arcanesoft\Foundation\Authorization\Metrics\Users\Concerns\CanAuthorize;
use Arcanesoft\Foundation\Authorization\Repositories\UsersRepository;
use Illuminate\Http\Request;

/**
 * Class     UsersPerMinute
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersPerMinute extends Trend
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
        return $this->countByMinutes($repo->query());
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            30   => __(':minutes Minutes', ['minutes' => 30]),
            60   => __(':minutes Minutes', ['minutes' => 60]),
            120  => __(':minutes Minutes', ['minutes' => 120]),
            180  => __(':minutes Minutes', ['minutes' => 180]),
            240  => __(':minutes Minutes', ['minutes' => 240]),
        ];
    }
}
