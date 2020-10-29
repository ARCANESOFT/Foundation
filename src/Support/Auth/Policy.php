<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Auth;

use Arcanedev\LaravelPolicies\Policy as AbstractPolicy;

/**
 * Class     Policy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Policy extends AbstractPolicy
{
    /**
     * Check the ability.
     *
     * @param  string       $ability
     * @param  array|mixed  $data
     *
     * @return bool
     */
    public static function can(string $ability, $data = []): bool
    {
        return static::user()->can(static::ability($ability), $data);
    }

    /**
     * Get the authenticated user.
     *
     * @return \Arcanesoft\Foundation\Authorization\Models\Administrator|\Arcanesoft\Foundation\Authorization\Models\User|mixed
     */
    public static function user()
    {
        return auth()->user();
    }
}
