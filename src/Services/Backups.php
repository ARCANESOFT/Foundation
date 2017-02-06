<?php namespace Arcanesoft\Foundation\Services;

use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;

/**
 * Class     Backups
 *
 * @package  Arcanesoft\Foundation\Services
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Backups
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get all the statuses.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function statuses()
    {
        return BackupDestinationStatusFactory::createForMonitorConfig(config('laravel-backup.monitorBackups'));
    }

    /**
     * Get a status by index.
     *
     * @param  int  $index
     *
     * @return \Spatie\Backup\Tasks\Monitor\BackupDestinationStatus|null
     */
    public static function getStatus($index)
    {
        return static::statuses()->get($index);
    }
}
