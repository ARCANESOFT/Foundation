<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Requests\Administrators;

use Arcanesoft\Foundation\Auth\Http\Requests\FormRequest;
use Arcanesoft\Foundation\Auth\Rules\Administrators\EmailRule;

/**
 * Class     CreateAdministratorRequest
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Requests\Administrators
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
            'last_name'  => [
                'required',
                'string',
                'max:50',
            ],
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                EmailRule::unique(),
            ],
            'password'   => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
            'roles'      => [
                'array',
                'min:1',
            ],
        ];
    }
}
