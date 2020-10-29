<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Requests\Profile;

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
        // TODO: Replace with the new Password Object
        return [
            'old_password' => ['required', 'string', 'min:8', 'password'],
            'password'     => ['required', 'string', 'min:8', 'confirmed', 'different:old_password'],
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
            'password',
        ]);
    }
}
