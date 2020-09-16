<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Console;

use Arcanesoft\Foundation\ModuleManifest;
use Illuminate\Console\Command;

/**
 * Class     DiscoverCommand
 *
 * @package  Arcanesoft\Foundation\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DiscoverCommand extends Command
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
    protected $signature = 'arcanesoft:discover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Discover ARCANESOFT's modules";

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the command.
     *
     * @param  \Arcanesoft\Foundation\ModuleManifest  $manifest
     */
    public function handle(ModuleManifest $manifest): void
    {
        foreach (array_keys($manifest->modules()) as $module) {
            $this->line("Discovered Module: <info>{$module}</info>");
        }

        $this->info("Arcanesoft's Modules manifest generated successfully.");
    }
}
