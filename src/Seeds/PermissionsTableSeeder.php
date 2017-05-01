<?php namespace Arcanesoft\Foundation\Seeds;

use Arcanesoft\Auth\Seeds\PermissionsSeeder;
use Arcanesoft\Foundation\Policies\BackupPolicy;
use Arcanesoft\Foundation\Policies\LogViewerPolicy;

/**
 * Class     PermissionTableSeeder
 *
 * @package  Arcanesoft\Foundation\Seeds
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsTableSeeder extends PermissionsSeeder
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
                'group'       => [
                    'name'        => 'Foundation',
                    'slug'        => 'foundation',
                    'description' => 'Foundation permissions group',
                ],
                'permissions' => array_merge(
                    $this->getSettingsPermissions(),
                    $this->getLogViewerPermissions(),
                    $this->getBackupsPermissions()
                ),
            ],
        ]);
    }

    /* -----------------------------------------------------------------
     |  Permissions
     | -----------------------------------------------------------------
     */

    /**
     * Get the Settings permissions.
     *
     * @return array
     */
    private function getSettingsPermissions()
    {
        return [
            [
                'name'        => 'Settings - View the general settings',
                'description' => 'Allow to view the general settings.',
                'slug'        => 'foundation.settings.general', // TODO: Create Settings Policies
            ],
        ];
    }

    /**
     * Get the LogViewer permissions.
     *
     * @return array
     */
    private function getLogViewerPermissions()
    {
        return [
            [
                'name'        => 'LogViewer - View dashboard',
                'description' => 'Allow to view the LogViewer dashboard.',
                'slug'        => LogViewerPolicy::PERMISSION_DASHBOARD,
            ],
            [
                'name'        => 'LogViewer - List all logs',
                'description' => 'Allow to list all the logs.',
                'slug'        => LogViewerPolicy::PERMISSION_LIST,
            ],
            [
                'name'        => 'LogViewer - View a log',
                'description' => 'Allow to display a log.',
                'slug'        => LogViewerPolicy::PERMISSION_SHOW,
            ],
            [
                'name'        => 'LogViewer - Download a log',
                'description' => 'Allow to download a log.',
                'slug'        => LogViewerPolicy::PERMISSION_DOWNLOAD,
            ],
            [
                'name'        => 'LogViewer - Delete a log',
                'description' => 'Allow to delete a log.',
                'slug'        => LogViewerPolicy::PERMISSION_DELETE,
            ],
        ];
    }

    /**
     * Get the Backups permissions.
     *
     * @return array
     */
    private function getBackupsPermissions()
    {
        return [
            [
                'name'        => 'Backups - List all backup monitors',
                'description' => 'Allow to list all the logs.',
                'slug'        => BackupPolicy::PERMISSION_LIST,
            ],
            [
                'name'        => 'Backups - View a backup monitor',
                'description' => 'Allow to display a backup monitor.',
                'slug'        => BackupPolicy::PERMISSION_SHOW,
            ],
            [
                'name'        => 'Backups - Create backups',
                'description' => 'Allow to create backups.',
                'slug'        => BackupPolicy::PERMISSION_CREATE,
            ],
            [
                'name'        => 'Backups - Delete/Clear backups',
                'description' => 'Allow to delete or clear backups.',
                'slug'        => BackupPolicy::PERMISSION_DELETE,
            ],
        ];
    }
}
