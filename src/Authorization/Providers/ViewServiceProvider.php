<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Providers;

use Arcanesoft\Foundation\Support\Providers\ViewServiceProvider as ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Get the view composers.
     *
     * @return array
     */
    public function components(): array
    {
        return [
            //
        ];
    }
}
