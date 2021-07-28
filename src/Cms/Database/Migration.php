<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Database;

use Arcanedev\Support\Database\Migration as BaseMigration;

/**
 * Class     Migration
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Migration extends BaseMigration
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Migration constructor.
     */
    public function __construct()
    {
        $this->setConnection(config('arcanesoft.foundation.cms.database.connection'));
        $this->setPrefix(config('arcanesoft.foundation.cms.database.prefix'));
    }
}
