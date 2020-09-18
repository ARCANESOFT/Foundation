<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Metrics\LogViewer;

use Arcanedev\LaravelMetrics\Metrics\Value;
use Arcanedev\LogViewer\Contracts\LogViewer;
use Illuminate\Http\Request;

/**
 * Class     LogFilesCount
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogFilesCount extends Value
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the metric.
     *
     * @param  \Illuminate\Http\Request                  $request
     * @param  \Arcanedev\LogViewer\Contracts\LogViewer  $logViewer
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed|void
     */
    public function calculate(Request $request, LogViewer $logViewer)
    {
        $count = $logViewer->all()->count();

        return $this->result($count);
    }
}
