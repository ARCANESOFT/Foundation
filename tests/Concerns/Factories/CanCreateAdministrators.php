<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Tests\Concerns\Factories;

use Arcanesoft\Foundation\Auth\Database\Factories\AdministratorFactory;
use Arcanesoft\Foundation\Auth\Models\Administrator;

/**
 * Trait     CanCreateAdministrators
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait CanCreateAdministrators
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the administrator factory builder.
     *
     * @return \Arcanesoft\Foundation\Auth\Database\Factories\AdministratorFactory
     */
    protected static function administratorFactory(): AdministratorFactory
    {
        return AdministratorFactory::new();
    }

    /**
     * Create an administrator
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Administrator
     */
    protected static function createAdministrator(array $attributes = []): Administrator
    {
        return static::administratorFactory()->create($attributes);
    }

    /**
     * Make an administrator
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Administrator
     */
    protected static function makeAdministrator(array $attributes = []): Administrator
    {
        return static::administratorFactory()->make($attributes);
    }
}
