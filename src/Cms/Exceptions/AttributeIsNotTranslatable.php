<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Exceptions;

use Exception;

/**
 * Class     AttributeIsNotTranslatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttributeIsNotTranslatable extends Exception
{
    /**
     * @param  string  $key
     * @param  mixed   $model
     *
     * @return static
     */
    public static function make(string $key, $model): self
    {
        $attributes = implode(', ', $model->getTranslatableAttributes());

        return new static(
            "Cannot translate attribute `{$key}` as it's not one of the translatable attributes: `$attributes`"
        );
    }
}
