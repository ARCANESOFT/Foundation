<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Database;

use Arcanesoft\Foundation\Core\Database\Seeders\{PermissionSeeder, RoleSeeder};
use Arcanesoft\Foundation\Support\Database\Seeder;

/**
 * Class     DatabaseSeeder
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DatabaseSeeder extends Seeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the seeders.
     *
     * @return array
     */
    public function seeders(): array
    {
        return [
            PermissionSeeder::class,
            RoleSeeder::class,
        ];
    }
}
