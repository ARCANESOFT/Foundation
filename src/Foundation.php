<?php namespace Arcanesoft\Foundation;

/**
 * Class     Foundation
 *
 * @package  Arcanesoft\Foundation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Foundation
{
    /* ------------------------------------------------------------------------------------------------
     |  Constants
     | ------------------------------------------------------------------------------------------------
     */
    const VERSION = '0.6.3';

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the package version.
     *
     * @return string
     */
    public function version()
    {
        return self::VERSION;
    }
}
