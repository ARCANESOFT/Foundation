<?php declare(strict_types=1);

namespace Arcanesoft\Foundation;

/**
 * Class     Arcanesoft
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Arcanesoft
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VERSION = '4.0.0';

    const ARCANESOFT_MODULES_CACHE = 'cache/modules.php';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Indicates if migrations will be run.
     *
     * @var bool
     */
    public static $runsMigrations = true;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the version.
     *
     * @return string
     */
    public function version(): string
    {
        return static::VERSION;
    }

    /**
     * Get the template path.
     *
     * @return string
     */
    public function template(): string
    {
        return 'foundation::_template.master';
    }
}
