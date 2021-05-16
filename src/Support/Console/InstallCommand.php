<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Console;

use Illuminate\Console\Command;

/**
 * Class     InstallCommand
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class InstallCommand extends Command
{
    /* -----------------------------------------------------------------
     |  Common methods
     | -----------------------------------------------------------------
     */

    /**
     * Call another console commands.
     *
     * @param  iterable  $commands
     */
    protected function callMany(iterable $commands)
    {
        foreach ($commands as $command => $arguments) {
            if (is_numeric($command) && is_string($arguments)) {
                $command   = $arguments;
                $arguments = [];
            }

            $this->call($command, $arguments);
        }
    }

    /**
     * Call the seeder.
     *
     * @param  string  $seeder
     *
     * @return int
     */
    protected function seed(string $seeder): int
    {
        $this->line('<info>Seeding:</info> '.$seeder);

        return $this->callSilent('db:seed', ['--class' => $seeder]);
    }
}
