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
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */
    const VIEW = 'foundation::admin.system.information._includes.folders-permissions';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Compose the view.
     *
     * @param  \Illuminate\View\View  $view
     */
    public function compose(View $view)
    {
        $permissions = $this->prepare([
            'storage/app/',
            'storage/framework/',
            'storage/logs/',
            'bootstrap/cache/',
        ]);

        $view->with('permissions', $permissions);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */
    /**
     * Prepare the permissions.
     *
     * @param  array  $folders
     *
     * @return \Illuminate\Support\Collection
     */
    private function prepare(array $folders)
    {
        return collect($folders)->mapWithKeys(function ($folder) {
            $path = base_path($folder);

            return [
                $folder => [
                    'chmod'    => (int) substr(sprintf('%o', fileperms($path)), -4),
                    'writable' => is_writable($path),
                ],
            ];
        });
    }
}
