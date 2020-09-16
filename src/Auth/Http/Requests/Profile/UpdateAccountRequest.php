<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Requests\Profile;

use Arcanesoft\Foundation\Auth\Http\Requests\FormRequest;
use Arcanesoft\Foundation\Auth\Rules\Users\EmailRule;
use Arcanesoft\Foundation\Authentication\Concerns\UseAdministratorGuard;

/**
 * Class     UpdateUserAccountRequest
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Requests\Profile
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateAccountRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UseAdministratorGuard;

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
        /** @var  \Arcanesoft\Foundation\Auth\Models\Administrator  $user */
        $user = $this->user($this->getGuardName());

        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'  => ['required', 'string', 'max:50'],
            'email'      => ['required', 'string', 'email', 'max:255', EmailRule::unique()->ignore($user->getKey())],
        ];
    }
}
