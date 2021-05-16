<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Metrics\PasswordResets;

use Arcanedev\LaravelMetrics\Metrics\Value;
use Arcanesoft\Foundation\Authorization\Metrics\PasswordResets\Concerns\CanAuthorize;
use Arcanesoft\Foundation\Authorization\Repositories\PasswordResetsRepository;
use Illuminate\Http\Request;

/**
 * Class     TotalPasswordResets
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TotalPasswordResets extends Value
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
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\PasswordResetsRepository  $repo
     *
     * @return mixed
     */
    public function calculate(Request $request, PasswordResetsRepository $repo)
    {
        return $this->result($repo->count());
    }
}
