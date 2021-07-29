<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Entities;

use Arcanesoft\Foundation\Cms\Cms;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Locale;
use Symfony\Component\Intl\Locales;

class LanguageCollection extends Collection
{
    public static function build($locale = null): self
    {
        $languages = [];

        foreach (Locales::getNames($locale ?: Cms::getLocale()) as $code => $name) {
            $languages[$code] = Str::ucfirst($name);
        }

        return new static($languages);
    }
}
