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
        $this->arcanesoftHeader();

        if ($this->confirm('Do you wish to reset the application ? [y|N]')) {
            $this->setup();
        }
    }

    /**
     * Display arcanesoft header.
     */
    private function arcanesoftHeader()
    {
        $this->comment('    ___    ____  _________    _   _____________ ____  ____________');
        $this->comment('   /   |  / __ \/ ____/   |  / | / / ____/ ___// __ \/ ____/_  __/');
        $this->comment('  / /| | / /_/ / /   / /| | /  |/ / __/  \__ \/ / / / /_    / /   ');
        $this->comment(' / ___ |/ _, _/ /___/ ___ |/ /|  / /___ ___/ / /_/ / __/   / /    ');
        $this->comment('/_/  |_/_/ |_|\____/_/  |_/_/ |_/_____//____/\____/_/     /_/     ');
        $this->line('');

        // Copyright
        $this->comment('Version ' . foundation()->version() . ' | 2015-2016 | Created by ARCANEDEV(c)');
        $this->line('');
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

        $this->call('db:seed', [
            '--class' => \Arcanesoft\Foundation\Seeds\DatabaseSeeder::class
        ]);

        $this->comment('Database seeded !');
        $this->line('');
    }
}
