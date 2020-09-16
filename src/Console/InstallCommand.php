<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Console;

use Arcanesoft\Foundation\Auth\Console\InstallCommand as AuthInstallCommand;
use Arcanesoft\Foundation\Core\Console\InstallCommand as CoreInstallCommand;
use Arcanesoft\Foundation\ModuleManifest;
use Arcanesoft\Foundation\Support\Console\InstallCommand as Command;
use Arcanesoft\Foundation\System\Console\InstallCommand as SystemInstallCommand;

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
    protected $signature = 'arcanesoft:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install ARCANESOFT';

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
        $this->line('');

        $this->installFoundation();
        $this->installModules($manifest);

        $this->line('');

        $this->info("ARCANESOFT has been installed successfully.");
    }

    /**
     * Install ARCANESOFT's Foundation.
     */
    protected function installFoundation(): void
    {
        $this->comment('Installing Foundation...');

        $this->callMany([
            CoreInstallCommand::class,
            AuthInstallCommand::class,
            SystemInstallCommand::class,
        ]);
    }

    /**
     * Install ARCANESOFT's modules.
     *
     * @param  \Arcanesoft\Foundation\ModuleManifest  $manifest
     */
    protected function installModules(ModuleManifest $manifest): void
    {
        $this->comment('Installing Modules...');

        $this->callMany($manifest->config('install'));
    }
}
