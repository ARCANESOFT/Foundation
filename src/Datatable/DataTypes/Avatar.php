<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable\DataTypes;

/**
 * Class     Avatar
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Avatar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the data.
     *
     * @param  string       $image
     * @param  string|null  $alt
     *
     * @return array
     */
    public function transform(string $image, ?string $alt): array
    {
        return [
            'image' => $image,
            'alt'   => $alt,
        ];
    }
}
