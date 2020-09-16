<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Requests\Users;

use Arcanesoft\Foundation\Auth\Http\Routes\UsersRoutes;
use Arcanesoft\Foundation\Auth\Rules\Users\EmailRule;

/**
 * Class     UpdateUserRequest
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Requests\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateUserRequest extends UserFormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the validation's rules.
     *
     * @return array
     */
    public function rules(): array
    {
        $user = $this->getCurrentUser();

        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'  => ['required', 'string', 'max:50'],
            'email'      => ['required', 'string', 'email', 'max:255', EmailRule::unique()->ignore($user->id)],
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the current user.
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User|mixed
     */
    protected function getCurrentUser()
    {
        return $this->route()->parameter(UsersRoutes::USER_WILDCARD);
    }
}
