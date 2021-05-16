<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable\DataTypes;

/**
 * Class     BadgeActive
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BadgeActive
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the data.
     *
     * @param  bool         $active
     * @param  string|null  $label
     * @param  bool         $asIcon
     *
     * @return array
     */
    public function transform(bool $active, ?string $label = null, bool $asIcon = true): array
    {
        if (is_null($label)) {
            $label = $active ? 'Activated' : 'Deactivated';
        }

        return [
            'active' => $active,
            'label'  => __($label),
            'icon'   => $asIcon,
        ];
    }
}
