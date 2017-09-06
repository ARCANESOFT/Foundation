<?php namespace Arcanesoft\Foundation\ViewComposers\System;

use Illuminate\View\View;

/**
 * Class     PhpInfoComposer
 *
 * @package  Arcanesoft\Foundation\ViewComposers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PhpInfoComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VIEW = 'foundation::admin.system.information._includes.php-info';

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
        $view->with('phpInfo', [
            'version'      => phpversion(),
            'extensions'   => get_loaded_extensions(),
            'requirements' => $this->checkPhpRequirements(),
        ]);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the PHP requirements.
     *
     * @return \Illuminate\Support\Collection
     */
    private function checkPhpRequirements()
    {
        return collect(['openssl', 'pdo', 'mbstring', 'tokenizer', 'xml'])->mapWithKeys(function ($requirement) {
            return [$requirement => extension_loaded($requirement)];
        });
    }
}
