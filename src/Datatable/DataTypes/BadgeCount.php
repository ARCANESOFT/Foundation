<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable\DataTypes;

/**
 * Class     BadgeCount
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BadgeCount
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the data.
     *
     * @param  int|float    $count
     * @param  string|null  $label
     *
     * @return array
     */
    public function transform($count, string $label = null): array
    {
        return [
            'count' => $count,
            'label' => is_null($label) ? $label : __($label),
        ];
    }
}
