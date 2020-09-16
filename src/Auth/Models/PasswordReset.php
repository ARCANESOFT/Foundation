<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models;

use Arcanesoft\Foundation\Auth\Auth;

/**
 * Class     PasswordReset
 *
 * @package  Arcanesoft\Foundation\Auth\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  string                      email
 * @property  string                      token
 * @property  \Illuminate\Support\Carbon  created_at
 */
class PasswordReset extends Model
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const UPDATED_AT = null;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(Auth::table('password-resets', 'password_resets'));

        parent::__construct($attributes);
    }
}
