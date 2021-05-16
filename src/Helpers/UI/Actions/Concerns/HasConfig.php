<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Helpers\UI\Actions\Concerns;

/**
 * Trait     HasConfig
 *
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
