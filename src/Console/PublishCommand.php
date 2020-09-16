<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Console;

use Arcanesoft\Foundation\ModuleManifest;
use Arcanesoft\Foundation\Support\Console\PublishCommand as Command;

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
    protected $signature = 'arcanesoft:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all the ARCANESOFT modules';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the command.
     *
     * @param  \Arcanesoft\Foundation\ModuleManifest  $manifest
     */
    public function handle(ModuleManifest $manifest)
    {
        $this->line('');
        $this->info('Publishing the modules...');

        $tags = [
            'arcanesoft-assets',
            'arcanesoft-config',
            'arcanesoft-translations',
            'arcanesoft-views',
        ];

        $this->publishFoundation();
        $this->publishModules($manifest);

//        foreach ($tags as $tag) {
//            $this->comment("Publishing [{$tag}]");
//            $this->callSilent('vendor:publish', ['--tag' => $tag]);
//        }
    }

    /**
     * Publish Foundation.
     */
    public function publishFoundation(): void
    {

    }

    /**
     * Publish modules.
     *
     * @param  \Arcanesoft\Foundation\ModuleManifest  $manifest
     */
    public function publishModules(ModuleManifest $manifest): void
    {
        foreach ($manifest->config('publish') as $command) {
            $this->call($command);
        }
    }
}
