<?php namespace Arcanesoft\Foundation\Seeds;

use Arcanesoft\Auth\Seeds\PermissionsSeeder;

/**
 * Class     PermissionTableSeeder
 *
 * @package  Arcanesoft\Foundation\Seeds
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsTableSeeder extends PermissionsSeeder
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->seed([
            [
                'group'       => [
                    'name'        => 'Foundation',
                    'slug'        => 'foundation',
                    'description' => 'Foundation permissions group',
                ],
                'permissions' => array_merge(
                    $this->getLogViewerSeeds()
                ),
            ],
        ]);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the LogViewer permissions.
     *
     * @return array
     */
    private function getLogViewerSeeds()
    {
        return [
            [
                'name'        => 'LogViewer - View dashboard',
                'description' => 'Allow to view the LogViewer dashboard.',
                'slug'        => 'foundation.logviewer.dashboard',
            ],[
                'name'        => 'LogViewer - List all logs',
                'description' => 'Allow to list all the logs.',
                'slug'        => 'foundation.logviewer.list',
            ],[
                'name'        => 'LogViewer - View a log',
                'description' => 'Allow to display a log.',
                'slug'        => 'foundation.logviewer.show',
            ],[
                'name'        => 'LogViewer - Download a log',
                'description' => 'Allow to download a log.',
                'slug'        => 'foundation.logviewer.download',
            ],[
                'name'        => 'LogViewer - Delete a log',
                'description' => 'Allow to delete a log.',
                'slug'        => 'foundation.logviewer.delete',
            ]
        ];
    }
}