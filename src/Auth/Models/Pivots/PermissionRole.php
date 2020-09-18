<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class     PermissionRole
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                         permission_id
 * @property  int                         role_id
 * @property  \Illuminate\Support\Carbon  created_at
 */
class PermissionRole extends Pivot
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permission_id' => 'integer',
        'role_id'       => 'integer',
    ];

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the name of the "updated at" column.
     *
     * @return string
     */
    public function getUpdatedAtColumn()
    {
        return null;
    }
}
