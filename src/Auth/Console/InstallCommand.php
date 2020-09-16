<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Console;

use Arcanesoft\Foundation\Auth\Database\DatabaseSeeder;
use Arcanesoft\Foundation\Support\Console\InstallCommand as Command;

/**
 * Class     InstallCommand
 *
 * @package  Arcanesoft\Foundation\Auth\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InstallCommand extends Command
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the command.
     */
    public function handle(): void
    {
        $this->seed(DatabaseSeeder::class);
    }
}
