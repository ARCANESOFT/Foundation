<?php namespace Arcanesoft\Foundation\Helpers\UI\Actions\Concerns;

/**
 * Trait     HasConfig
 *
 * @package  Arcanesoft\Foundation\Helpers\UI\Actions\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasConfig
{
    /**
     * Get the action config value.
     *
     * @param  string  $name
     *
     * @return mixed
     */
    protected static function getActionConfig($name)
    {
        return config('arcanesoft.foundation.ui.actions.'.strtolower($name));
    }
}
