<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Console;

use Arcanesoft\Foundation\Cms\Database\DatabaseSeeder;
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
    public function handle(): int
    {
        $this->seed(DatabaseSeeder::class);

        return static::SUCCESS;
    }
}
