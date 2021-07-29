<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Database\Seeders;

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
            'name'        => 'CMS',
            'slug'        => 'cms',
            'description' => 'CMS permissions group',
        ], $this->getPermissionsFromPolicyManager('admin::cms.'));
    }
}
