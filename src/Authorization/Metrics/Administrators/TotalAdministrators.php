<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\Administrators;

use Arcanedev\LaravelMetrics\Metrics\Value;
use Arcanesoft\Foundation\Authorization\Metrics\Administrators\Concerns\CanAuthorize;
use Arcanesoft\Foundation\Authorization\Repositories\AdministratorsRepository;
use Illuminate\Http\Request;

/**
 * Class     TotalAdministrators
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TotalAdministrators extends Value
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
}
