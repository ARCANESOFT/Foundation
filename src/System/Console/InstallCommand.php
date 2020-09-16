<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Console;

use Arcanesoft\Foundation\Support\Console\InstallCommand as Command;
use Arcanesoft\Foundation\System\Database\DatabaseSeeder;

/**
 * Class     InstallCommand
 *
 * @package  Arcanesoft\Foundation\System\Console
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
