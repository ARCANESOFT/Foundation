<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Requests\Categories;

use Arcanesoft\Foundation\Cms\Cms;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class     UpdateCategoryRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateCategoryRequest extends FormRequest
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
        $locales = Cms::getLocales();

        return [
            'slug'         => ['required', 'string'],
            'name'         => ['array:'.$locales->implode(',')],
            'name.*'       => ['required', 'string'],
            'description'  => ['array:'.$locales->implode(',')],
            'description.' => ['nullable', 'string'],
            'parent'       => [],
        ];
    }
}
