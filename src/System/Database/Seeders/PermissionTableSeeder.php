<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Database\Seeders;

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
            'name'        => 'System',
            'slug'        => 'system',
            'description' => 'System permissions group',
        ], $this->getPermissionsFromPolicyManager('admin::system.'));
    }
}
