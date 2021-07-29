<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Repositories;

use Arcanesoft\Foundation\Cms\Cms;
use Arcanesoft\Foundation\Cms\Entities\LanguageCollection;
use Arcanesoft\Foundation\Cms\Models\Language;
use Illuminate\Support\{Collection, Str};
use Symfony\Component\Intl\Locales;

/**
 * Class     LanguagesRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LanguagesRepository extends Repository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model FQN class.
     *
     * @return string
     */
    public static function modelClass(): string
    {
        return Cms::model('language', Language::class);
    }

    /**
     * Create a new language.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Cms\Models\Language|mixed
     */
    public function createOne(array $attributes): Language
    {
        return $this->create($attributes);
    }

    /**
     * Delete the given language.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Language  $language
     */
    public function deleteOne(Language $language)
    {
        //
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    public function getAvailableLanguages()
    {
        $ignore = $this->pluck('code')->toArray();

        return Collection::make(Locales::getNames(Cms::getLocale()))
            ->unless(empty($ignore), function (Collection $items) use ($ignore) {
                return $items->reject(function (string $name, string $locale) use ($ignore) {
                    return in_array($locale, $ignore);
                });
            })
            ->transform(function (string $language, string $code) {
                return Str::ucfirst($language);
            })
        ;
    }
}
