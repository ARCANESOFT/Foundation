<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Database\Seeders;

use Arcanesoft\Foundation\Auth\Models\Role;
use Arcanesoft\Foundation\Core\Database\RolesSeeder;

/**
 * Class     RoleTableSeeder
 *
 * @package  Arcanesoft\Foundation\Auth\Database\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoleTableSeeder extends RolesSeeder
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
        $this->seedMany([
            [
                'name'        => 'Administrator',
                'key'         => Role::ADMINISTRATOR,
                'description' => 'The system administrator role',
                'is_locked'   => true,
            ],
            [
                'name'        => 'Moderator',
                'key'         => 'moderator',
                'description' => 'The moderator role',
                'is_locked'   => true,
            ],
            [
                'name'        => 'Auth Moderator',
                'key'         => 'auth-moderator',
                'description' => 'The auth moderator role',
                'is_locked'   => true,
            ],
        ]);

        $this->syncRolesWithPermissions([
            'moderator'      => [
                'admin::dashboard.index',
            ],
            'auth-moderator' => [
                'admin::dashboard.index',
                'admin::auth.*',
            ],
        ]);
    }
}
