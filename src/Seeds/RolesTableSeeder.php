<?php namespace Arcanesoft\Foundation\Seeds;

use Arcanesoft\Auth\Seeds\RolesSeeder;

/**
 * Class     RoleTableSeeder
 *
 * @package  Arcanesoft\Auth\Seeds\Foundation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesTableSeeder extends RolesSeeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->seed([
            [
                'name'        => 'LogViewer Manager',
                'description' => 'The LogViewer manager role.',
                'is_locked'   => true,
            ],[
                'name'        => 'RouteViewer Manager',
                'description' => 'The RouteViewer manager role.',
                'is_locked'   => true,
            ],
        ]);

        $this->syncAdminRole();

        $this->syncRoles([
            'logviewer-manager' => 'foundation.logviewer.',
            'routeviewer-manager' => 'foundation.routeviewer.',
        ]);
    }
}
