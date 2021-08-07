<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Validation\Rules;

use Arcanesoft\Foundation\Cms\Cms;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class     Translated
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Translated implements Rule
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * {@inheritDoc}
     */
    public function passes($attribute, $value): bool
    {
        $diff = array_diff(Cms::getLocales()->toArray(), array_keys($value));

        return empty($diff);
    }

    /**
     * {@inheritDoc}
     */
    public function message(): string
    {
        return trans('arcanesoft::validation.localized');
    }

    /**
     * Get the translated field's rules.
     *
     * @param  string|array  $name
     * @param  array         $rules
     *
     * @return array
     */
    public static function rules($name, array $rules = []): array
    {
        if (is_string($name))
            return [
                "{$name}"   => ['array:'.Cms::getLocales()->implode(','), new static],
                "{$name}.*" => $rules,
            ];

        $result = [];

        foreach ($name as $attribute => $rules) {
            $result = array_merge($result, static::rules($attribute, $rules));
        }

        return $result;
    }
}
