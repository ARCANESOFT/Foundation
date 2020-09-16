<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Actions\Login;

use Arcanesoft\Foundation\Authentication\Concerns\UseAdministratorGuard;
use Arcanesoft\Foundation\Fortify\Actions\Authentication\Login\AttemptToAuthenticate as Action;

/**
 * Class     AttemptToAuthenticate
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttemptToAuthenticate extends Action
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UseAdministratorGuard;
}
