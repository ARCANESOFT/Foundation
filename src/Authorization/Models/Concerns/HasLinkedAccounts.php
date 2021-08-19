<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Models\Concerns;

use Arcanesoft\Foundation\Authorization\Models\SocialiteProvider;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait     HasLinkedAccounts
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property-read  \Illuminate\Database\Eloquent\Collection|\Arcanesoft\Foundation\Authorization\Models\SocialiteProvider[]  linkedAccounts
 */
trait HasLinkedAccounts
{
    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Get the socialite providers' relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function linkedAccounts(): HasMany
    {
        return $this->hasMany(SocialiteProvider::class);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the user has a registered social provider.
     *
     * @param  string  $type
     *
     * @return bool
     */
    public function hasLinkedAccount(string $type): bool
    {
        if ($this->relationLoaded('linkedAccounts')) {
            return $this->linkedAccounts
                ->where('provider_type', $type)
                ->isNotEmpty();
        }

        return $this->linkedAccounts()
            ->where('provider_type', $type)
            ->exists();
    }
}
