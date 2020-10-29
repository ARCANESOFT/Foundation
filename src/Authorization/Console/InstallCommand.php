<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Console;

use Arcanesoft\Foundation\Authorization\Database\DatabaseSeeder;
use Arcanesoft\Foundation\Support\Console\InstallCommand as Command;

/**
 * Class     InstallCommand
 *
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
