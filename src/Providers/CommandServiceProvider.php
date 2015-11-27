<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\Providers\CommandServiceProvider as ServiceProvider;

/**
 * Class     CommandServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CommandServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerPublishCommand();

        $this->commands($this->commands);
    }

    /**
     * Get the provided commands.
     *
     * @return array
     */
    public function provides()
    {
        return [
            \Arcanesoft\Foundation\Console\PublishCommand::class,
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Commands Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register publish command.
     */
    private function registerPublishCommand()
    {
        $this->singleton(
            'arcanesoft.foundation.commands.publish',
            \Arcanesoft\Foundation\Console\PublishCommand::class
        );

        $this->commands[] = \Arcanesoft\Foundation\Console\PublishCommand::class;
    }
}
