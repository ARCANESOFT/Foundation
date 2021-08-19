<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Traits;

use Arcanesoft\Foundation\Cms\Cms;
use Arcanesoft\Foundation\Cms\Events\Translations\TranslationHasBeenSet;
use Arcanesoft\Foundation\Cms\Exceptions\AttributeIsNotTranslatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Trait     HasTranslations
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  array  translatable
 */
trait HasTranslations
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string|null */
    protected $translationLocale = null;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * @param  string  $locale
     *
     * @return $this
     */
    public function setLocale(string $locale): self
    {
        $this->translationLocale = $locale;

        return $this;
    }

    /**
     * Get the locale.
     *
     * @return string
     */
    public function getLocale(): string
    {
        return $this->translationLocale ?: Cms::getLocale();
    }

    /**
     * @param  string  $key
     * @param  array   $translations
     *
     * @return $this
     */
    public function setTranslations(string $key, array $translations): self
    {
        $this->guardAgainstNonTranslatableAttribute($key);

        foreach ($translations as $locale => $translation) {
            $this->setTranslation($key, $locale, $translation);
        }

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Set the locale.
     *
     * @param  string  $locale
     *
     * @return $this
     */
    public static function usingLocale(string $locale): self
    {
        return (new static)->setLocale($locale);
    }

    /**
     * @param  string  $key
     *
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        if ( ! $this->isTranslatableAttribute($key))
            return parent::getAttributeValue($key);

        return $this->getTranslation($key, $this->getLocale());
    }

    public function setAttribute($key, $value)
    {
        if ($this->isTranslatableAttribute($key) && is_array($value)) {
            return $this->setTranslations($key, $value);
        }

        // Pass arrays and untranslatable attributes to the parent method.
        if ( ! $this->isTranslatableAttribute($key) || is_array($value)) {
            return parent::setAttribute($key, $value);
        }

        // If the attribute is translatable and not already translated,
        // set a translation for the current app locale.
        return $this->setTranslation($key, $this->getLocale(), $value);
    }

    /**
     * @param  string  $key
     * @param  string  $locale
     * @param  bool    $useFallbackLocale
     *
     * @return mixed
     */
    public function translate(string $key, string $locale = '', bool $useFallbackLocale = true)
    {
        return $this->getTranslation($key, $locale, $useFallbackLocale);
    }

    /**
     * @param  string  $key
     * @param  string  $locale
     * @param  bool    $useFallbackLocale
     *
     * @return mixed
     */
    public function getTranslation(string $key, string $locale, bool $useFallbackLocale = true)
    {
        $locale = $this->normalizeLocale($key, $locale, $useFallbackLocale);

        $translation = $this->getTranslations($key)[$locale] ?? '';

        if ($this->hasGetMutator($key))
            return $this->mutateAttribute($key, $translation);

        return $translation;
    }

    /**
     * @param  string  $key
     * @param  string  $locale
     *
     * @return mixed|string
     */
    public function getTranslationWithFallback(string $key, string $locale)
    {
        return $this->getTranslation($key, $locale, true);
    }

    /**
     * @param  string  $key
     * @param  string  $locale
     *
     * @return mixed|string
     */
    public function getTranslationWithoutFallback(string $key, string $locale)
    {
        return $this->getTranslation($key, $locale, false);
    }

    public function getTranslations(string $key = null): array
    {
        if ($key !== null) {
            $this->guardAgainstNonTranslatableAttribute($key);

            return array_filter(
                json_decode($this->getAttributes()[$key] ?? '' ?: '{}', true) ?: [],
                function($value) { return $value !== null && $value !== ''; }
            );
        }

        return array_reduce($this->getTranslatableAttributes(), function ($result, $item) {
            $result[$item] = $this->getTranslations($item);

            return $result;
        });
    }

    public function setTranslation(string $key, string $locale, $value): self
    {
        $this->guardAgainstNonTranslatableAttribute($key);

        $translations = $this->getTranslations($key);

        $oldValue = $translations[$locale] ?? '';

        if ($this->hasSetMutator($key)) {
            $method = 'set'.Str::studly($key).'Attribute';

            $this->{$method}($value, $locale);

            $value = $this->attributes[$key];
        }

        $translations[$locale] = $value;

        $this->attributes[$key] = $this->asJson($translations);

        event(new TranslationHasBeenSet($this, $key, $locale, $oldValue, $value));

        return $this;
    }

    public function forgetTranslation(string $key, string $locale): self
    {
        $translations = $this->getTranslations($key);

        unset(
            $translations[$locale],
            $this->$key
        );

        $this->setTranslations($key, $translations);

        return $this;
    }

    public function forgetAllTranslations(string $locale): self
    {
        collect($this->getTranslatableAttributes())->each(function (string $attribute) use ($locale) {
            $this->forgetTranslation($attribute, $locale);
        });

        return $this;
    }

    public function getTranslatedLocales(string $key): array
    {
        return array_keys($this->getTranslations($key));
    }

    public function replaceTranslations(string $key, array $translations): self
    {
        foreach ($this->getTranslatedLocales($key) as $locale) {
            $this->forgetTranslation($key, $locale);
        }

        $this->setTranslations($key, $translations);

        return $this;
    }

    public function getTranslatableAttributes(): array
    {
        return is_array($this->translatable)
            ? $this->translatable
            : [];
    }

    public function getTranslationsAttribute(): array
    {
        return Collection::make($this->getTranslatableAttributes())
            ->mapWithKeys(function (string $key) {
                return [$key => $this->getTranslations($key)];
            })
            ->toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function getCasts(): array
    {
        return array_merge(
            parent::getCasts(),
            array_fill_keys($this->getTranslatableAttributes(), 'array')
        );
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  string  $key
     * @param  string  $locale
     * @param  bool    $useFallbackLocale
     *
     * @return string
     */
    protected function normalizeLocale(string $key, string $locale, bool $useFallbackLocale): string
    {
        if (in_array($locale, $this->getTranslatedLocales($key)))
            return $locale;

        if ( ! $useFallbackLocale)
            return $locale;

        if ( ! is_null($fallbackLocale = Cms::getFallbackLocale()))
            return $fallbackLocale;

        return $locale;
    }

    public function isTranslatableAttribute(string $key): bool
    {
        return in_array($key, $this->getTranslatableAttributes());
    }

    public function hasTranslation(string $key, string $locale = null): bool
    {
        $locale = $locale ?: $this->getLocale();

        return isset($this->getTranslations($key)[$locale]);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  string  $key
     *
     * @throws \Arcanesoft\Foundation\Cms\Exceptions\AttributeIsNotTranslatable
     */
    protected function guardAgainstNonTranslatableAttribute(string $key): void
    {
        if ( ! $this->isTranslatableAttribute($key))
            throw AttributeIsNotTranslatable::make($key, $this);
    }
}
