<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Models\Presenters;

use Arcanesoft\Foundation\Cms\Cms;
use Illuminate\Support\Str;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;

/**
 * Trait     LanguagePresenter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property-read  string  name
 * @property-read  string  language_name
 * @property-read  string  language_code
 * @property-read  string  country_name
 * @property-read  string  country_code
 */
trait LanguagePresenter
{
    /* -----------------------------------------------------------------
     |  Accessors & Mutators
     | -----------------------------------------------------------------
     */

    /**
     * Get the `name` attribute.
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->hasCountry()
            ? "{$this->language_name} ({$this->country_name})"
            : $this->language_name;
    }

    /**
     * Get the `country_name` attribute.
     *
     * @return string|null
     */
    public function getCountryNameAttribute(): ?string
    {
        if (is_null($country = $this->country_code))
            return $country;

        return Countries::getName($country, Cms::getLocale());
    }

    /**
     * Get the `language_name` attribute.
     *
     * @return string
     */
    public function getLanguageNameAttribute(): string
    {
        $name = Locales::getName($this->language_code, Cms::getLocale());

        return Str::ucfirst($name);
    }

    /**
     * Get the `language_code` attribute.
     *
     * @return string
     */
    public function getLanguageCodeAttribute(): string
    {
        if ( ! $this->hasCountry())
            return $this->code;

        return explode('_', $this->code)[0];
    }

    /**
     * Get the `country_code` attribute.
     *
     * @return string|null
     */
    public function getCountryCodeAttribute(): ?string
    {
        if ( ! $this->hasCountry())
            return null;

        return explode('_', $this->code)[1];
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the locale has the country.
     *
     * @return bool
     */
    public function hasCountry(): bool
    {
        return $this->hasCodeSeparator();
    }

    /**
     * Determine if the locale has a code separator.
     *
     * @return bool
     */
    protected function hasCodeSeparator(): bool
    {
        return Str::contains($this->code, '_');
    }
}
