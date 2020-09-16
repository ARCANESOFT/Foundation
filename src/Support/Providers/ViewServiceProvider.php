<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers;

use Arcanesoft\Foundation\Views\Contracts\Manager;
use Illuminate\Support\ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
 * @package  Arcanesoft\Foundation\Support\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class ViewServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the view composers.
     *
     * @return string[]|array
     */
    public function composers(): array
    {
        return [];
    }

    /**
     * Get the view composers.
     *
     * @return array
     */
    public function components(): array
    {
        return [];
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register bindings in the container.
     */
    public function boot(): void
    {
        $this->registerViewComposers();
        $this->registerViewComponents();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the view composers.
     */
    protected function registerViewComposers(): void
    {
        /** @var  \Illuminate\View\Factory  $factory */
        $factory = $this->app['view'];

        if ( ! empty($composers = $this->getRegisteredViewComposers())) {
            $factory->composers($composers);
        }
    }

    /**
     * Get the components manager.
     *
     * @return \Arcanesoft\Foundation\Views\Contracts\Manager
     */
    protected function getComponentsManager(): Manager
    {
        return $this->app->make(Manager::class);
    }

    /**
     * Register the view components.
     */
    protected function registerViewComponents(): void
    {
        $this->getComponentsManager()->register($this->components());
    }

    /**
     * Get the registered view composers.
     *
     * @return array
     */
    protected function getRegisteredViewComposers(): array
    {
        $composers = [];

        foreach ($this->composers() as $composer) {
            $composers[$composer] = $this->app->call("{$composer}@views");
        }

        return $composers;
    }
}
