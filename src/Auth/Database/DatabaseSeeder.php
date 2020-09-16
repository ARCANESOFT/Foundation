<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Database;

use Arcanesoft\Foundation\Support\Database\Seeder;
use Arcanesoft\Foundation\Auth\Database\Seeders\{
    PermissionTableSeeder, RoleTableSeeder, UserTableSeeder
};

/**
 * Class     DatabaseSeeder
 *
 * @package  Arcanesoft\Foundation\Auth\Seeders
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
            UserTableSeeder::class,
        ];
    }
}
