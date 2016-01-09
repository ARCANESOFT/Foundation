<?php namespace Arcanesoft\Foundation\Console;

use Arcanedev\Support\Bases\Command;

/**
 * Class     SetupCommand
 *
 * @package  Arcanesoft\Foundation\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SetupCommand extends Command
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
    protected $signature = 'foundation:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Foundation setup command.';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $arguments = [
            '--quiet' => true,
        ];

        if ($this->confirm('Do you wish to reset the application ? [y|N]')) {
            $this->publishAllModules($arguments);
            $this->setupAllModules($arguments);
        }
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Publish all modules : configs, migrations, assets ...
     *
     * @param  array  $arguments
     */
    private function publishAllModules($arguments)
    {
        $this->call('foundation:publish', $arguments);

        $this->call('optimize');

        $this->info('All modules are published !');
    }

    /**
     * Setup all modules.
     *
     * @param  array  $arguments
     */
    private function setupAllModules($arguments)
    {
        $this->call('migrate:refresh');

        // Setup the auth module.
        $this->call('auth:setup', $arguments);
    }
}
