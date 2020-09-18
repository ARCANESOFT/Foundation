<?php

namespace Arcanesoft\Foundation\Views;

use Arcanesoft\Foundation\Support\Providers\ServiceProvider;
use Arcanesoft\Foundation\Views\Contracts\Manager as ManagerContract;

/**
 * Class     ViewsServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewsServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string|null
     */
    protected $package = 'components';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        parent::register();

        $this->singleton(ManagerContract::class, Manager::class);
    }
}
