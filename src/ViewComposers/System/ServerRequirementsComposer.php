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
    /* ------------------------------------------------------------------------------------------------
     |  Constants
     | ------------------------------------------------------------------------------------------------
     */
    const VIEW_NAME = 'foundation::admin.system.information._includes.server-requirements';

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
        $requirements['php'] = $this->checkPhpRequirements([
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'xml',
        ]);

        $requirements['apache'] = $this->checkApacheRequirements([
            'mod_rewrite',
        ]);

        $view->with('requirements', $requirements);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check the PHP requirements.
     *
     * @param  array  $requirements
     *
     * @return \Illuminate\Support\Collection
     */
    private function checkPhpRequirements(array $requirements)
    {
        $requirements = array_combine($requirements, $requirements);

        return collect($requirements)->transform(function ($requirement) {
            return extension_loaded($requirement);
        });
    }

    /**
     * Check the APACHE requirements.
     *
     * @param  array  $requirements
     *
     * @return \Illuminate\Support\Collection
     */
    private function checkApacheRequirements(array $requirements)
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
