<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Models\Concerns;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Models\Session;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait     HasSessions
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  \Illuminate\Database\Eloquent\Collection|\Arcanesoft\Foundation\Authorization\Models\Session[]  sessions
 */
trait HasSessions
{
    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * The sessions' relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Auth::model('session', Session::class), 'user_id')
            ->where('guard', static::guardName());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the guard's name.
     *
     * @return string
     */
    abstract public static function guardName(): string;
}
