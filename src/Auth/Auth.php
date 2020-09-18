<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth;

use Arcanesoft\Foundation\Auth\Models\Administrator;
use Arcanesoft\Foundation\Authentication\Guard;
use Illuminate\Support\Str;

/**
 * Class     Auth
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Auth
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Indicates if migrations will be run.
     *
     * @var bool
     */
    public static $runsMigrations = true;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Publish the migrations.
     */
    public static function publishMigrations(): void
    {
        static::$runsMigrations = false;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the authenticated administrator.
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Administrator|mixed
     */
    public static function admin(): Administrator
    {
        return auth(Guard::WEB_ADMINISTRATOR)->user();
    }

    /**
     * Get the auth table name.
     *
     * @param  string       $name
     * @param  string|null  $default
     * @param  bool         $prefixed
     *
     * @return string
     */
    public static function table(string $name, $default = null, $prefixed = true): string
    {
        $name = static::config("database.tables.{$name}", $default);

        return $prefixed
            ? static::prefixTable($name)
            : $name;
    }

    /**
     * Get the model class by the given key.
     *
     * @param  string       $name
     * @param  string|null  $default
     *
     * @return string
     */
    public static function model(string $name, $default = null): string
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
    public static function makeModel(string $name, $default = null)
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
     * Slug the role's key.
     *
     * @param  string  $value
     *
     * @return string
     */
    public static function slugRoleKey(string $value): string
    {
        return Str::slug($value, '-');
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
        $key = is_null($key) ? 'arcanesoft.foundation.auth' : "arcanesoft.foundation.auth.{$key}";

        return config()->get($key, $default);
    }

    /**
     * Get the username used for authentication.
     *
     * @return string
     */
    public static function username(): string
    {
        return 'email';
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the given user is a super admin.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $user
     *
     * @return bool
     */
    public static function isSuperAdmin(Administrator $user): bool
    {
        $emails = (array) static::config('administrators.emails');

        if (empty($emails))
            return false;

        return in_array($user->email, $emails);
    }

    /**
     * Check if the login feature is enabled.
     *
     * @return bool
     */
    public static function isLoginEnabled(): bool
    {
        return Auth::config('authentication.login.enabled', false);
    }

    /**
     * Determine if the two factor authentication is enabled.
     *
     * @return bool
     */
    public static function isTwoFactorEnabled(): bool
    {
        return (bool) static::config('authentication.two-factor.enabled', false);
    }

    /**
     * Determine if the socialite authentication is enabled.
     *
     * @return bool
     */
    public static function isSocialiteEnabled(): bool
    {
        return Socialite::isEnabled();
    }

    /**
     * Check if the registration feature is enabled.
     *
     * @return bool
     */
    public static function isRegistrationEnabled(): bool
    {
        return (bool) static::config('authentication.register.enabled', false);
    }
}
