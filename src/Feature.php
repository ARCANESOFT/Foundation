<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation;

/**
 * Class     Feature
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Feature
{
    /**
     * Determine if the given feature is enabled.
     *
     * @param  string  $feature
     *
     * @return bool
     */
    public static function enabled(string $feature): bool
    {
        return in_array($feature, config()->get('arcanesoft.foundation.features', []));
    }

    /**
     * Determine if the application has terms of service / privacy policy confirmation enabled.
     *
     * @return bool
     */
    public static function hasTermsFeature()
    {
        return static::enabled('terms');
    }
}
