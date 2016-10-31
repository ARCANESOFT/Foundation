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
    const VIEW_NAME = 'foundation::system.information._includes.server-requirements';

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
        $requirements = $this->checkRequirements([
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer'
        ]);

        $view->with('requirements', $requirements);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check the server requirements.
     *
     * @param  array  $requirements
     *
     * @return \Illuminate\Support\Collection
     */
    private function checkRequirements(array $requirements)
    {
        $requirements = array_combine($requirements, $requirements);

        return collect($requirements)->transform(function ($requirement) {
            return extension_loaded($requirement);
        });
    }
}
