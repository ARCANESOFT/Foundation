<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support;

/**
 * Class     Date
 *
 * @package  Arcanesoft\Foundation\Support
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Date
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  string|int  $year
     * @param  string      $separator
     *
     * @return string
     */
    public static function since($year, string $separator = ' - '): string
    {
        $current = now();

        return $current->year > (int) $year
            ? $year.$separator.$current->year
            : $year;
    }
}
