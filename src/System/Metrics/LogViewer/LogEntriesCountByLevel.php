<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Metrics\LogViewer;

use Arcanedev\LaravelMetrics\Metrics\Partition;
use Arcanedev\LogViewer\Contracts\LogViewer;
use Arcanedev\LogViewer\Entities\Log;
use Illuminate\Http\Request;

/**
 * Class     LogEntriesCountByLevel
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogEntriesCountByLevel extends Partition
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
        $value = static::calculateEntriesByLevel($logViewer);

        return $this
            ->result($value)
            ->labels($logViewer->levelsNames())
            ->colors($this->getLevelColors());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the entries by level.
     *
     * @param  \Arcanedev\LogViewer\Contracts\LogViewer  $logViewer
     *
     * @return array
     */
    private static function calculateEntriesByLevel(LogViewer $logViewer): array
    {
        return $logViewer->all()->reduce(function ($count, Log $log) {
            foreach ($log->entries()->groupBy('level') as $level => $entries) {
                /** @var  \Arcanedev\LogViewer\Entities\LogEntryCollection  $entries */
                $count[$level] = ($count[$level] ?? 0) + $entries->count();
            }

            return $count;
        }) ?: [];
    }

    /**
     * Get the level's colors.
     *
     * @return array
     */
    private function getLevelColors(): array
    {
        return config('log-viewer.colors.levels', []);
    }
}
