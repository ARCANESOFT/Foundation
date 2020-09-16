<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Users\Attributes;

use Arcanesoft\Foundation\Auth\Events\Users\UserEvent;
use Arcanesoft\Foundation\Auth\Models\User;

/**
 * Class     UpdatedEmail
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Users\Attributes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdatedEmail extends UserEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    public $oldEmail;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * UpdatedEmail constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     * @param  string                                   $oldEmail
     */
    public function __construct(User $user, string $oldEmail)
    {
        parent::__construct($user);

        $this->oldEmail = $oldEmail;
    }
}
