<?php namespace Arcanesoft\Foundation\ViewComposers\System;

use FilesystemIterator;
use Illuminate\View\View;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Class     ApplicationInfoComposer
 *
 * @package  Arcanesoft\Foundation\ViewComposers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ApplicationInfoComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */
    const VIEW = 'foundation::admin.system.information._includes.application';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Compose the view.
     *
     * @param  \Illuminate\View\View  $view
     */
    public function compose(View $view)
    {
        $app = app();

        $view->with('application', [
            'url'                 => config('app.url'),
            'locale'              => strtoupper(config('app.locale')),
            'timezone'            => config('app.timezone'),
            'debug_mode'          => config('app.debug', false),
            'maintenance_mode'    => $app->isDownForMaintenance(),
            'arcanesoft_version'  => foundation()->version(),
            'laravel_version'     => $app->version(),
            'app_size'            => $this->getApplicationSize(),
            'database_connection' => config('database.default'),
            'cache_driver'        => config('cache.default'),
            'session_driver'      => config('session.driver')
        ]);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */
    /**
     * Get the application size.
     *
     * @return string
     */
    private function getApplicationSize()
    {
        $iterator = new RecursiveDirectoryIterator(base_path(), FilesystemIterator::SKIP_DOTS);

        $size = 0;

        foreach (new RecursiveIteratorIterator($iterator) as $object) {
            $size += $object->getSize();
        }

        return $this->formatSize($size);
    }

    /**
     * Format the size for humans.
     *
     * @param  int  $bytes
     *
     * @return string
     */
    private function formatSize($bytes)
    {
        $kb = 1024;
        $mb = $kb * 1024;
        $gb = $mb * 1024;
        $tb = $gb * 1024;

        if (($bytes >= 0) && ($bytes < $kb)) {
            return $bytes . ' B';
        }
        elseif (($bytes >= $kb) && ($bytes < $mb)) {
            return ceil($bytes / $kb).' KB';
        }
        elseif (($bytes >= $mb) && ($bytes < $gb)) {
            return ceil($bytes / $mb).' MB';
        }
        elseif (($bytes >= $gb) && ($bytes < $tb)) {
            return ceil($bytes / $gb).' GB';
        }
        elseif ($bytes >= $tb) {
            return ceil($bytes / $tb).' TB';
        }

        return $bytes.' B';
    }
}
