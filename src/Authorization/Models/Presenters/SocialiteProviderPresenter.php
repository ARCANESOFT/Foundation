<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Models\Presenters;

use Arcanesoft\Foundation\Authorization\Entities\SocialiteProvider as SocialiteProviderEntity;
use Arcanesoft\Foundation\Authorization\Socialite;

/**
 * Trait     SocialiteProviderPresenter
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property-read  string  name
 */
trait SocialiteProviderPresenter
{
    /* -----------------------------------------------------------------
     |  Presenters
     | -----------------------------------------------------------------
     */

    /**
     * Get the `name` attribute.
     *
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->getSocialiteProvider()->name ?: $this->provider_type;
    }

    /**
     * Get the `icon` attribute.
     *
     * @return string
     */
    public function getIconAttribute(): string
    {
        return $this->getSocialiteProvider()->icon;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the socialite provider.
     *
     * @return \Arcanesoft\Foundation\Authorization\Entities\SocialiteProvider
     */
    protected function getSocialiteProvider(): SocialiteProviderEntity
    {
        return Socialite::getProvider($this->provider_type, function() {
            return new SocialiteProviderEntity;
        });
    }
}
