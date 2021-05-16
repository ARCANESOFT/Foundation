<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable\DataTypes;

/**
 * Class     Status
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Status
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the data.
     *
     * @param  string       $type
     * @param  string|null  $label
     *
     * @return array
     */
    public function transform(string $type, ?string $label = null): array
    {
        return [
            'type'  => $type,
            'label' => is_null($label) ? $label : __($label),
        ];
    }
}
