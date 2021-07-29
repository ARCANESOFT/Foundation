<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Requests\Languages;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class     CreateLocaleRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateLanguagesRequest extends FormRequest
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
            'code' => ['required', 'string'],
        ];
    }
}
