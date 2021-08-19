<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Events\TwoFactorAuthentication;

use Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\HasTwoFactor;

/**
 * Class     ReplacedRecoveryCode
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ReplacedRecoveryCode extends TwoFactorEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The recovery code.
     *
     * @var string
     */
    public $code;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  \Arcanesoft\Foundation\Fortify\Contracts\TwoFactorAuthentication\HasTwoFactor  $user
     * @param  string                                                                         $code
     */
    public function __construct(HasTwoFactor $user, string $code)
    {
        parent::__construct($user);

        $this->code = $code;
    }
}
