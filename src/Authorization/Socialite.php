<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization;

use Arcanesoft\Foundation\Authorization\Entities\SocialiteProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Facades\Socialite as LaravelSocialite;

/**
 * Class     Socialite
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Socialite
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the supported providers.
     *
     * @return \Illuminate\Support\Collection|\Arcanesoft\Foundation\Authorization\Entities\SocialiteProvider[]
     */
    public static function getProviders(): Collection
    {
        $providers = Auth::config('authentication.socialite.providers', []);

        return Collection::make($providers)->transform(function (array $provider, string $key) {
            return new SocialiteProvider(array_merge($provider, ['type' => $key]));
        });
    }

    /**
     * Get the accepted socialite providers.
     *
     * @return \Illuminate\Support\Collection|\Arcanesoft\Foundation\Authorization\Entities\SocialiteProvider[]
     */
    public static function getEnabledProviders(): Collection
    {
        return static::getProviders()->filter(function (SocialiteProvider $provider) {
            return $provider->enabled ?? false;
        });
    }

    /**
     * Get the provider's authorization.
     *
     * @param  string  $provider
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function getProviderAuthorization(string $provider): RedirectResponse
    {
        $options = config("services.{$provider}", []);

        return tap(static::driver($provider), function (Provider $socialite) use ($provider, $options) {
            $scopes = $options['scopes'] ?? [];
            $with   = $options['with'] ?? [];
            $fields = $options['fields'] ?? [];

            if ( ! empty($scopes))
                $socialite->scopes($scopes);

            if ( ! empty($with))
                $socialite->with($with);

            if ( ! empty($fields))
                $socialite->fields($fields);
        })->redirect();
    }

    /**
     * Get the socialite's user.
     *
     * @param  string  $provider
     *
     * @return \Laravel\Socialite\Contracts\User|\Laravel\Socialite\One\User|\Laravel\Socialite\Two\User
     */
    public static function user(string $provider)
    {
        return static::driver($provider)->user();
    }

    /**
     * Get the socialite's driver.
     *
     * @param  string  $provider
     *
     * @return \Laravel\Socialite\Contracts\Provider
     */
    public static function driver(string $provider)
    {
        return LaravelSocialite::driver($provider);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the socialite authentication is enabled.
     *
     * @return bool
     */
    public static function isEnabled(): bool
    {
        return (bool) Auth::config('authentication.socialite.enabled', false);
    }

    /**
     * Check if the given provider is supported.
     *
     * @param  string  $provider
     *
     * @return bool
     */
    public static function isProviderEnabled(string $provider): bool
    {
        return static::getEnabledProviders()->has($provider);
    }

    /**
     * Get a social provider.
     *
     * @param  string      $provider
     * @param  mixed|null  $default
     *
     * @return \Arcanesoft\Foundation\Authorization\Entities\SocialiteProvider|mixed|null
     */
    public static function getProvider(string $provider, $default = null)
    {
        return static::getProviders()->get($provider, $default);
    }
}
