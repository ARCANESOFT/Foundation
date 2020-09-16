<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Database;

use Arcanedev\Support\Database\Migration as BaseMigration;
use Arcanesoft\Foundation\Auth\Auth;

/**
 * Class     Migration
 *
 * @package  Arcanesoft\Auth\Database
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Migration extends BaseMigration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Migration constructor.
     */
    public function __construct()
    {
        $this->setConnection(Auth::config('database.connection'));
        $this->setPrefix(Auth::config('database.prefix'));
    }
}
