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
        if ( ! $this->confirm('Do you wish to reset the application ? [y|N]')) {
            return;
        }

        $options = $this->getDefaultOptions();

        $this->publishAllModules($options);
        $this->setupAllModules($options);
        $this->seedFoundation($options);
    }

    /**
     * Get the default options.
     *
     * @return array
     */
    private function getDefaultOptions()
    {
        return $arguments = [
            '--quiet' => true,
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Publish all modules : configs, migrations, assets ...
     *
     * @param  array  $options
     */
    private function publishAllModules(array $options)
    {
        $this->call('foundation:publish', $options);

        $this->call('optimize');

        $this->info('All modules are published !');
    }

    /**
     * Setup all modules.
     *
     * @param  array  $options
     */
    private function setupAllModules(array $options)
    {
        $this->call('migrate:refresh', $options);

        // Setup the auth module.
        $this->call('auth:setup', $options);
    }

    /**
     * Seed Foundation.
     */
    private function seedFoundation(array $options)
    {
        $this->call('db:seed', array_merge($options, [
            '--class' => \Arcanesoft\Foundation\Seeds\DatabaseSeeder::class
        ]));
    }
}
