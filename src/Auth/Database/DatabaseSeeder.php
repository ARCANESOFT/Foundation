<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Database;

use Arcanesoft\Foundation\Support\Database\Seeder;
use Arcanesoft\Foundation\Auth\Database\Seeders\{PermissionTableSeeder, RoleTableSeeder};

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
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
        ];
    }
}
