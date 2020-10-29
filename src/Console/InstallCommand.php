<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Console;

use Arcanesoft\Foundation\Authorization\Console\InstallCommand as AuthInstallCommand;
use Arcanesoft\Foundation\Core\Console\InstallCommand as CoreInstallCommand;
use Arcanesoft\Foundation\ModuleManifest;
use Arcanesoft\Foundation\Support\Console\InstallCommand as Command;
use Arcanesoft\Foundation\System\Console\InstallCommand as SystemInstallCommand;
use Closure;

/**
 * Class     InstallCommand
 *
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
        $this->info("<fg=blue>
    ___    ____  _________    _   _____________ ____  ____________
   /   |  / __ \/ ____/   |  / | / / ____/ ___// __ \/ ____/_  __/
  / /| | / /_/ / /   / /| | /  |/ / __/  \__ \/ / / / /_    / /
 / ___ |/ _  _/ /___/ ___ |/ /|  / /___ ___/ / /_/ / __/   / /
/_/  |_/_/ |_|\____/_/  |_/_/ |_/_____//____/\____/_/     /_/</>");
        $this->info('Created by ARCANEDEV');
        $this->newLine();

        $this->installFoundation();

        $this->newLine();

        $this->installModules($manifest);

        $this->newLine();
        $this->info("ARCANESOFT has been installed successfully ( ^o^)b");
    }

    /**
     * Install ARCANESOFT's Foundation.
     */
    protected function installFoundation(): void
    {
        $this->comment('Installing ARCANESOFT Foundation...');

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
        $this->comment('Installing ARCANESOFT Modules...');

        $modules = $manifest->pluck('install');

        $installed = [];

        $this->progressBar($modules, function ($command, $module) use (&$installed) {
            $this->callSilent($command);
            $installed[] = $module;
        });

        if ( ! empty($installed)) {
            $this->newLine(2);

            $this->info('Installed modules:');
            foreach ($installed as $module) {
                $this->comment($module);
            }
        }
    }

    /**
     * @param  array     $items
     * @param  \Closure  $callback
     */
    protected function progressBar(array $items, Closure $callback): void
    {
        $bar = $this->output->createProgressBar(count($items));
        $bar->start();

        foreach ($items as $key => $value) {
            $callback($value, $key, $bar);
            $bar->advance();
        }

        $bar->finish();
    }
}
