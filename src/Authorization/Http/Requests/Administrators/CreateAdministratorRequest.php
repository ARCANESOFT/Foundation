<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Requests\Administrators;

use Arcanesoft\Foundation\Authorization\Rules\Administrators\EmailRule;
use Arcanesoft\Foundation\Fortify\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class     CreateAdministratorRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateAdministratorRequest extends FormRequest
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
                EmailRule::unique(),
            ],
            'password' => Password::make()->nullable()->confirmed()->rules(),
            // TODO: Validate the roles array
            'roles' => [
                'array',
                'min:1',
            ],
        ];
    }
}
