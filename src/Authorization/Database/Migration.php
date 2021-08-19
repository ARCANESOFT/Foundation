<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Database;

use Arcanedev\Support\Database\Migration as BaseMigration;
use Arcanesoft\Foundation\Authorization\Auth;

/**
 * Class     Migration
 *
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
