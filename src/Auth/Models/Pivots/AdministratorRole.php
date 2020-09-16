<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class     AdminRole
 *
 * @package  Arcanesoft\Foundation\Auth\Models\Pivots
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                         admin_id
 * @property  int                         role_id
 * @property  \Illuminate\Support\Carbon  created_at
 */
class AdministratorRole extends Pivot
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
        'admin_id' => 'integer',
        'role_id'  => 'integer',
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
