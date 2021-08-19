<?php declare(strict_types=1);

namespace Arcanesoft\Foundation;

use Composer\Script\Event;
use Illuminate\Foundation\Application;

/**
 * Class     ComposerScripts
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ComposerScripts
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the post-autoload-dump Composer event.
     *
     * @param  \Composer\Script\Event  $event
     */
    public static function postAutoloadDump(Event $event): void
    {
        $vendorPath = $event->getComposer()->getConfig()->get('vendor-dir');

        require_once "{$vendorPath}/autoload.php";

        static::clearCompiled($event);
    }

    /**
     * Handle the post-update Composer event.
     *
     * @param  \Composer\Script\Event  $event
     */
    public static function clearCompiled(Event $event): void
    {
        $laravel = new Application(getcwd());

        if (is_file($arcanesoft = $laravel->bootstrapPath(Arcanesoft::ARCANESOFT_MODULES_CACHE))) {
            @unlink($arcanesoft);
        }
    }
}
