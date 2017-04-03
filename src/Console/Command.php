<?php namespace Arcanesoft\Foundation\Console;

use Arcanedev\Support\Bases\Command as BaseCommand;

/**
 * Class     Command
 *
 * @package  Arcanesoft\Foundation\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Command extends BaseCommand
{
    /* -----------------------------------------------------------------
     |  Shared Methods
     | -----------------------------------------------------------------
     */
    /**
     * Display arcanesoft header.
     */
    protected function arcanesoftHeader()
    {
        $this->comment('    ___    ____  _________    _   _____________ ____  ____________');
        $this->comment('   /   |  / __ \/ ____/   |  / | / / ____/ ___// __ \/ ____/_  __/');
        $this->comment('  / /| | / /_/ / /   / /| | /  |/ / __/  \__ \/ / / / /_    / /   ');
        $this->comment(' / ___ |/ _, _/ /___/ ___ |/ /|  / /___ ___/ / /_/ / __/   / /    ');
        $this->comment('/_/  |_/_/ |_|\____/_/  |_/_/ |_/_____//____/\____/_/     /_/     ');
        $this->line('');

        // Copyright
        $this->comment('Version ' . foundation()->version() . ' | 2015-2016 | Created by ARCANEDEV(c)');
        $this->line('');
    }

    /**
     * Get the config repository.
     *
     * @return \Illuminate\Contracts\Config\Repository
     */
    protected function config()
    {
        return $this->laravel['config'];
    }
}
