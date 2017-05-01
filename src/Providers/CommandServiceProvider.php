<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\Providers\CommandServiceProvider as ServiceProvider;
use Arcanesoft\Foundation\Console;

/**
 * Class     CommandServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CommandServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Console commands.
     *
     * @var array
     */
    protected $commands = [
        Console\PublishCommand::class,
        Console\InstallCommand::class,
        Console\ClearCommand::class,
    ];
}
