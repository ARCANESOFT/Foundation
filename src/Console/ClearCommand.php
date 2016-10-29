<?php namespace Arcanesoft\Foundation\Console;

/**
 * Class     ClearCommand
 *
 * @package  Arcanesoft\Foundation\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ClearCommand extends Command
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foundation:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove the compiled class/view files, flush the application cache and remove the route/configuration cache files.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $commands = [
            'clear-compiled',
            'cache:clear',
            'config:clear',
            'route:clear',
            'view:clear',
        ];

        foreach ($commands as $command) {
            $this->call($command);
        }
    }
}
