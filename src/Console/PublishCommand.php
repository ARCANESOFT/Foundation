<?php namespace Arcanesoft\Foundation\Console;

use Arcanedev\Support\Bases\Command;

/**
 * Class     PublishCommand
 *
 * @package  Arcanesoft\Foundation\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PublishCommand extends Command
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
    protected $signature = 'foundation:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish foundation config, assets and other stuff.';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--provider' => \Arcanesoft\Foundation\FoundationServiceProvider::class,
        ]);

        $this->call('settings:publish');
        $this->call('auth:publish');
    }
}
