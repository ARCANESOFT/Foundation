<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Arcanesoft\Foundation\Authorization\Rules\Users\EmailRule;
use Arcanesoft\Foundation\Fortify\Rules\Password;

/**
 * Class     CreateUserRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateUserRequest extends FormRequest
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
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'  => ['required', 'string', 'max:50'],
            'email'      => ['required', 'string', 'email', 'max:255', EmailRule::unique()],
            'password'   => Password::make()->nullable()->confirmed()->rules(),
        ];
    }
}
