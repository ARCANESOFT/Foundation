<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Requests\Roles;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Http\Routes\RolesRoutes;
use Arcanesoft\Foundation\Auth\Rules\Users\UniqueKey;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class     UpdateRoleRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateRoleRequest extends FormRequest
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
        $role = $this->getCurrentRole();

        return [
            'name'          => [
                'required', 'string', Rule::unique(Auth::table('roles'), 'name')->ignore($role->id), (new UniqueKey)->ignore($role->id),
            ],
            'description'   => [
                'required', 'string',
            ],
            'permissions.*' => [
                'nullable', 'string', Rule::exists(Auth::table('permissions'), 'uuid'),
            ],
        ];
    }

    /**
     * Get the validated data.
     *
     * @return array
     */
    public function getValidatedData(): array
    {
        return $this->all([
            'name',
            'description',
            'permissions',
        ]);
    }

    /**
     * Get the current role.
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Role|mixed
     */
    private function getCurrentRole()
    {
        return $this->route()->parameter(RolesRoutes::ROLE_WILDCARD);
    }
}
