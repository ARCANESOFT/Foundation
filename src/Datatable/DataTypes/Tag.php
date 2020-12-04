<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable\DataTypes;

/**
 * Class     Tag
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Tag
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the data.
     *
     * @param  string  $label
     * @param  string  $color
     *
     * @return array
     */
    public function transform(string $label, string $color): array
    {
        return [
            'color' => $color,
            'label' => $label,
        ];
    }
}
