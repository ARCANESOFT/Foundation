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
        $this->registerSetupCommand();

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
            \Arcanesoft\Foundation\Console\SetupCommand::class,
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

    /**
     * Register setup command.
     */
    private function registerSetupCommand()
    {
        $this->singleton(
            'arcanesoft.foundation.commands.setup',
            \Arcanesoft\Foundation\Console\SetupCommand::class
        );

        $this->commands[] = \Arcanesoft\Foundation\Console\SetupCommand::class;
    }
}
