<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Database\Seeders;

use Arcanesoft\Foundation\Core\Database\RolesSeeder;

/**
 * Class     RoleTableSeeder
 *
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
                'name'        => 'CMS Moderator',
                'key'         => 'cms-moderator',
                'description' => 'The CMS moderator role',
                'is_locked'   => true,
            ],
        ]);

        $this->syncRolesWithPermissions([
            'cms-moderator' => [
                'admin::dashboard.index',
                'admin::cms.*',
            ],
        ]);
    }
}
