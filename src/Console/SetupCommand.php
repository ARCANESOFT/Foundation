<?php namespace Arcanesoft\Foundation\Console;

use Arcanesoft\Foundation\Seeds\DatabaseSeeder;

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
        $this->arcanesoftHeader();

        if ($this->confirm('Do you wish to reset the application ? [y|N]')) {
            $this->setup();
        }
    }

    /**
     * Run the setup.
     */
    private function setup()
    {
        $this->publishAllModules();
        $this->refreshMigrations();
        $this->seedAllModules();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Publish all modules : configs, migrations, assets ...
     */
    private function publishAllModules()
    {
        $this->frame('Publishing all the modules files');
        $this->line('');

        $this->call('foundation:publish');
        $this->call('optimize');

        $this->comment('All files are published !');
        $this->line('');
    }

    /**
     * Refresh migrations.
     */
    private function refreshMigrations()
    {
        $this->frame('Refreshing all the migrations');
        $this->line('');

        $this->call('migrate:refresh');

        $this->line('');
    }

    /**
     * Seed all modules.
     */
    private function seedAllModules()
    {
        $this->frame('Seeding the database');
        $this->line('');

        $this->call('auth:setup');
        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);

        $this->comment('Database seeded !');
        $this->line('');

        foreach ($this->config()->get('arcanesoft.foundation.modules.setup', []) as $setup) {
            $this->call($setup);
        }
    }
}
