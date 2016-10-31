<?php namespace Arcanesoft\Foundation\ViewComposers\System;

use Illuminate\View\View;

/**
 * Class     FoldersPermissionsComposer
 *
 * @package  Arcanesoft\Foundation\ViewComposers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FoldersPermissionsComposer
{
    /* ------------------------------------------------------------------------------------------------
     |  Constants
     | ------------------------------------------------------------------------------------------------
     */
    const VIEW_NAME = 'foundation::system.information._includes.folders-permissions';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Compose the view.
     *
     * @param  \Illuminate\View\View  $view
     */
    public function compose(View $view)
    {
        $permissions = $this->checkPermissions([
            'storage/app/'       => 775,
            'storage/framework/' => 775,
            'storage/logs/'      => 775,
            'bootstrap/cache/'   => 775,
        ]);

        $view->with('permissions', $permissions);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check the permissions.
     *
     * @param  array  $folders
     *
     * @return \Illuminate\Support\Collection
     */
    private function checkPermissions(array $folders)
    {
        return collect($folders)->transform(function ($permission, $folder) {
            return [
                'chmod'   => $permission,
                'allowed' => $this->getFolderPermission($folder) >= $permission
            ];
        });
    }

    /**
     * Get a folder permission.
     *
     * @param  string  $folder
     *
     * @return int
     */
    private function getFolderPermission($folder)
    {
        return (int) substr(sprintf('%o', fileperms(base_path($folder))), -4);
    }
}
