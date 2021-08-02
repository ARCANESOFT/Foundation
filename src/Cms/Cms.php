<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms;

/**
 * Class     Cms
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Cms
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the auth table name.
     *
     * @param  string       $name
     * @param  string|null  $default
     * @param  bool         $prefixed
     *
     * @return string
     */
    public static function table(string $name, string $default = null, bool $prefixed = true): string
    {
        $name = static::config("database.tables.{$name}", $default);

        return $prefixed ? static::prefixTable($name) : $name;
    }

    /**
     * Get the model class by the given key.
     *
     * @param  string       $name
     * @param  string|null  $default
     *
     * @return string
     */
    public static function model(string $name, string $default = null): string
    {
        // TODO: Throw exception if not found ?

        return static::config("database.models.{$name}", $default);
    }

    /**
     * Get the model instance.
     *
     * @param  string       $name
     * @param  string|null  $default
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public static function makeModel(string $name, string $default = null)
    {
        return app()->make(static::model($name, $default));
    }

    /**
     * Add the auth prefix to the table.
     *
     * @param  string  $name
     *
     * @return string
     */
    public static function prefixTable(string $name): string
    {
        $prefix = static::config('database.prefix');

        return $prefix ? $prefix.$name : $name;
    }

    /**
     * Get a config value of this module.
     *
     * @param  string|null  $key
     * @param  mixed|null   $default
     *
     * @return mixed
     */
    public static function config(?string $key, $default = null)
    {
        $key = is_null($key) ? 'arcanesoft.foundation.cms' : "arcanesoft.foundation.cms.{$key}";

        return config()->get($key, $default);
    }

    /**
     * Get the current locale.
     *
     * @return string
     */
    public static function getLocale(): string
    {
        return app()->getLocale();
    }

    /**
     * Get the fallback locale.
     *
     * @return string
     */
    public static function getFallbackLocale(): string
    {
        return config('app.fallback_locale', static::getLocale());
    }
}
