<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Requests\Users;

use Arcanesoft\Foundation\Authorization\Http\Routes\Web\UsersRoutes;
use Arcanesoft\Foundation\Authorization\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Arcanesoft\Foundation\Authorization\Rules\Users\EmailRule;

/**
 * Class     UpdateUserRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateUserRequest extends FormRequest
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
            'first_name' => [
                'required',
                'string',
                'max:50',
            ],
            'last_name' => [
                'required',
                'string',
                'max:50',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                EmailRule::unique()->ignore($user->id)
            ],
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the current user.
     *
     * @return \Arcanesoft\Foundation\Authorization\Models\User|mixed
     */
    protected function getCurrentUser(): User
    {
        return $this->route()->parameter(UsersRoutes::USER_WILDCARD);
    }
}
