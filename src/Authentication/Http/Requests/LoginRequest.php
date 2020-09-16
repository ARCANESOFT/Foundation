<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Http\Requests;

use Arcanesoft\Foundation\Auth\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class     LoginRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LoginRequest extends FormRequest
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
            Auth::username() => ['required', 'string'],
            'password'       => ['required', 'string'],
        ];
    }
}
