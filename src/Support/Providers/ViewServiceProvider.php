<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
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
     * @return array
     */
    public function composers(): array
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
