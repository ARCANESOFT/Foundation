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
        $info['version']      = phpversion();
        $info['extensions']   = get_loaded_extensions();
        $info['requirements'] = $this->checkPhpRequirements();

        $view->with('phpInfo', $info);
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
        $requirements = ['openssl', 'pdo', 'mbstring', 'tokenizer', 'xml'];

        return collect(array_combine($requirements, $requirements))->transform(function ($requirement) {
            return extension_loaded($requirement);
        });
    }
}
