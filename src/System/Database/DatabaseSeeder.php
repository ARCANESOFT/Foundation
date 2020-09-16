<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Database;

use Arcanesoft\Foundation\Support\Database\Seeder;
use Arcanesoft\Foundation\System\Database\Seeders\{
    PermissionTableSeeder, RoleTableSeeder
};

/**
 * Class     DatabaseSeeder
 *
 * @package  Arcanesoft\Foundation\System\Database
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
