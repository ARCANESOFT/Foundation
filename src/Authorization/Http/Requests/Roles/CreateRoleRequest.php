<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Requests\Roles;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Rules\Users\UniqueKey;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class     CreateRoleRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateRoleRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(Auth::table('roles'), 'name'),
                new UniqueKey,
            ],
            'description' => [
                'required',
                'string',
            ],
            'permissions.*' => [
                'nullable',
                'string',
                Rule::exists(Auth::table('permissions'), 'uuid'),
            ],
        ];
    }
}
