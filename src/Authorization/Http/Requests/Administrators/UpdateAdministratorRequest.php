<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Requests\Administrators;

use Arcanesoft\Foundation\Authorization\Http\Routes\AdministratorsRoutes;
use Arcanesoft\Foundation\Authorization\Rules\Administrators\EmailRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class     UpdateAdministratorRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateAdministratorRequest extends FormRequest
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
                EmailRule::unique()->ignore($this->getCurrentAdministrator()->id),
            ],
            'roles'      => [
                'array',
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
    protected function getCurrentAdministrator()
    {
        return $this->route()->parameter(AdministratorsRoutes::WILDCARD_ADMIN);
    }
}
