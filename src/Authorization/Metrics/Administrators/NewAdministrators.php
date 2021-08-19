<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\Administrators;

use Arcanedev\LaravelMetrics\Metrics\RangedValue;
use Arcanesoft\Foundation\Authorization\Metrics\Administrators\Concerns\CanAuthorize;
use Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository;
use Illuminate\Http\Request;

/**
 * Class     NewAdministrators
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class NewAdministrators extends RangedValue
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
     * @param  \Illuminate\Http\Request                                                    $request
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository  $repo
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed
     */
    public function calculate(Request $request, AdministratorsRepository $repo)
    {
        return $this->count($repo->query());
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            1   => __('Today'),
            7   => __(':days Days', ['days' => 7]),
            30  => __(':days Days', ['days' => 30]),
            60  => __(':days Days', ['days' => 60]),
            365 => __(':days Days', ['days' => 365]),
        ];
    }
}
