<?php namespace Arcanesoft\Foundation\ViewComposers\System;

use Illuminate\View\View;

/**
 * Class     ServerRequirementsComposer
 *
 * @package  Arcanesoft\Foundation\ViewComposers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ServerRequirementsComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VIEW = 'foundation::admin.system.information._includes.server-requirements';

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
        $requirements['server']['ssl']     = $this->checkSslInstalled();
        $requirements['server']['modules'] = $this->getServerModules([
            'mod_rewrite',
        ]);

        $view->with('requirements', $requirements);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if SSL is installed.
     *
     * @return bool
     */
    private function checkSslInstalled()
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? true : false;
    }

    /**
     * Check the APACHE requirements.
     *
     * @param  array  $requirements
     *
     * @return \Illuminate\Support\Collection
     */
    private function getServerModules(array $requirements)
    {
        if ( ! function_exists('apache_get_modules')) {
            return collect([]);
        }

        $modules      = apache_get_modules();
        $requirements = array_combine($requirements, $requirements);

        return collect($requirements)->transform(function ($requirement) use ($modules) {
            return in_array($requirement, $modules);
        });
    }
}
