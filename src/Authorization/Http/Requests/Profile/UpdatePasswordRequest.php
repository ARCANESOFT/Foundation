<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Requests\Profile;

use Arcanesoft\Foundation\Authorization\Models\Administrator;
use Arcanesoft\Foundation\Fortify\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class     UpdatePasswordRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdatePasswordRequest extends FormRequest
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
            'current_password' => Password::make()->current(Administrator::guardName())->rules(),
            'password'         => Password::make()->confirmed()->rules(['different:current_password']),
        ];
    }
}
