<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Auth;

use Arcanedev\LaravelPolicies\Policy as AbstractPolicy;
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
     * Determine if the entity has the given abilities.
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
     * Determine if the entity has any of the given abilities.
     *
     * @param  array        $abilities
     * @param  array|mixed  $data
     *
     * @return bool
     */
    public static function canAny(array $abilities, $data = []): bool
    {
        return static::user()->canAny(static::ability($abilities), $data);
    }

    /**
     * Check the ability.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string                    $ability
     * @param  array|mixed               $data
     *
     * @return bool
     */
    public static function canFromRequest(Request $request, string $ability, $data = []): bool
    {
        return $request->user()->can(static::ability($ability), $data);
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
