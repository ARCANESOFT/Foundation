<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Views\Composers;

use Illuminate\Contracts\View\View;

/**
 * Class     RequiredPhpExtensionsComposer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RequiredPhpExtensionsComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VIEW = 'foundation::system._composers.required-php-extensions';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Compose the view.
     *
     * @param  \Illuminate\Contracts\View\View  $view
     */
    public function compose(View $view): void
    {
        $extensions = (array) config('arcanesoft.foundation.system.checks.php-extensions');;

        $view->with('requiredPhpExtensions', static::getRequiredExtensions($extensions));
    }

    /**
     * Get the composed views.
     *
     * @return array
     */
    public function views(): array
    {
        return [
            self::VIEW,
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the required extension (check also if loaded).
     *
     * @param  array  $extensions
     *
     * @return array
     */
    protected static function getRequiredExtensions(array $extensions): array
    {
        return array_map(function ($extension) {
            return extension_loaded($extension);
        }, array_combine($extensions, $extensions));
    }
}
