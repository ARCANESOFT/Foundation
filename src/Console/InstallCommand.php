<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Console;

use Arcanesoft\Foundation\Arcanesoft;
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
        $this->line("<fg=blue>
    ___    ____  _________    _   _____________ ____  ____________
   /   |  / __ \/ ____/   |  / | / / ____/ ___// __ \/ ____/_  __/
  / /| | / /_/ / /   / /| | /  |/ / __/  \__ \/ / / / /_    / /
 / ___ |/ _  _/ /___/ ___ |/ /|  / /___ ___/ / /_/ / __/   / /
/_/  |_/_/ |_|\____/_/  |_/_/ |_/_____//____/\____/_/     /_/</>");
        $this->newLine();
        $this->line('<fg=blue>Version '.Arcanesoft::VERSION.' - Created by ARCANEDEV</>');
        $this->newLine();

        $this->installFoundation();

        $this->newLine();

        $this->installModules($manifest);

        $this->newLine();
        $this->line('<fg=blue>ARCANESOFT has been installed successfully ( ^o^)b</>');
    }

    /**
     * Install ARCANESOFT's Foundation.
     */
    protected function installFoundation(): void
    {
        $this->comment('Installing ARCANESOFT Foundation...');

        $this->newLine();

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

        $this->newLine();

        $modules = $manifest->pluck('install');

        foreach ($modules as $module => $command) {
            $this->callSilent($command);
            $this->line("<fg=green>Installed:</> {$module}");
        }
    }
}
