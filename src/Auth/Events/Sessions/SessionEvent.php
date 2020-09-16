<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Sessions;

use Arcanesoft\Foundation\Auth\Models\Session;

/**
 * Class     SessionEvent
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Sessions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class SessionEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Session */
    public $session;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * SessionEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Session  $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
}
