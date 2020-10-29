<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Database\Seeders;

use Arcanesoft\Foundation\Core\Database\PermissionsSeeder;

/**
 * Class     PermissionTableSeeder
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionTableSeeder extends PermissionsSeeder
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
            'name'        => 'Auth',
            'slug'        => 'auth',
            'description' => 'Auth permissions group',
        ], $this->getPermissionsFromPolicyManager('admin::auth.'));
    }
}
