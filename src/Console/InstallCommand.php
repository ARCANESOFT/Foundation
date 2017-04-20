<?php namespace Arcanesoft\Foundation\Console;

use Arcanesoft\Foundation\Seeds\DatabaseSeeder;

/**
 * Class     InstallCommand
 *
 * @package  Arcanesoft\Foundation\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InstallCommand extends Command
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foundation:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Foundation install command.';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->arcanesoftHeader();

        if ($this->confirm('Do you wish to publish the modules ? [y or yes, default is no]')) {
            $this->publishAllModules();
        }

        if ($this->confirm('Do you wish to reset the migrations ? [y or yes, default is no]')) {
            $this->refreshMigrations();
            $this->installModules();
        }
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Publish all modules: configs, migrations, assets ...
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
    private function installModules()
    {
        $this->frame('Installing the modules');
        $this->line('');

        foreach ($this->config()->get('arcanesoft.foundation.modules.commands.install', []) as $command) {
            $this->call($command);
        }
        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);

        $this->line('');
        $this->comment('Modules installed !');
        $this->line('');
    }
}
