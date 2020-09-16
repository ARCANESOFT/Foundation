<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Database\Seeders;

use Arcanesoft\Foundation\Core\Database\PermissionsSeeder as Seeder;

/**
 * Class     PermissionSeeder
 *
 * @package  Arcanesoft\Foundation\Core\Database\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionSeeder extends Seeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seed([
            'name'        => 'Core',
            'slug'        => 'core',
            'description' => 'Core permissions group',
        ], $this->getPermissionsFromPolicyManager([
            'admin::dashboard.index',
        ]));
    }
}
