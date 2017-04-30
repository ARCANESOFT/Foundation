<?php namespace Arcanesoft\Foundation\Console;

use Arcanesoft\Foundation\FoundationServiceProvider;

/**
 * Class     PublishCommand
 *
 * @package  Arcanesoft\Foundation\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PublishCommand extends Command
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
    protected $signature = 'foundation:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish foundation config, assets and other stuff.';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('vendor:publish', ['--provider' => FoundationServiceProvider::class]);

        foreach ($this->config()->get('arcanesoft.foundation.modules.commands.publish', []) as $command) {
            $this->call($command);
        }
    }
}
