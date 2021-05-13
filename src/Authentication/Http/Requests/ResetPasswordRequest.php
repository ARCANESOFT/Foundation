<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Arcanesoft\Foundation\Fortify\Rules\Password;

/**
 * Class     ResetPasswordRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ResetPasswordRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Validation's rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => Password::make()->confirmed()->rules(),
        ];
    }
}
