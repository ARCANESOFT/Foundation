<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Events\Users\Attributes;

use Arcanesoft\Foundation\Authorization\Events\Users\UserEvent;
use Arcanesoft\Foundation\Authorization\Models\User;

/**
 * Class     UpdatedEmail
 *
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
     * @param  \Arcanesoft\Foundation\Authorization\Models\User  $user
     * @param  string                                   $oldEmail
     */
    public function __construct(User $user, string $oldEmail)
    {
        parent::__construct($user);

        $this->oldEmail = $oldEmail;
    }
}
