<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Requests\Categories;

use Arcanesoft\Foundation\Cms\Rules\Translated;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class     CreateCategoryRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateCategoryRequest extends FormRequest
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
        $rules = Translated::rules([
            'name'        => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ]);

        return array_merge($rules, [
            'slug'   => ['required', 'string'],
            'parent' => ['nullable'],
        ]);
    }
}
