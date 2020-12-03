<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Auth;

use Arcanedev\LaravelPolicies\Policy as AbstractPolicy;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Http\Request;

/**
 * Class     Policy
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Policy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

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
        return static::authorized(static::user(), $ability, $data);
    }

    /**
     * Check the ability.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string                    $ability
     * @param  array                     $data
     *
     * @return bool
     */
    public static function canFromRequest(Request $request, string $ability, $data = []): bool
    {
        return static::authorized($request->user(), $ability, $data);
    }

    /**
     * Determine if the given user is authorized.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Authorizable  $user
     * @param  string                                          $ability
     * @param  array                                           $data
     *
     * @return bool
     */
    public static function authorized(Authorizable $user, string $ability, $data = []): bool
    {
        return $user->can(static::ability($ability), $data);
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
