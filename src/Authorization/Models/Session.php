<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Models;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Events\Sessions\SessionEvent;
use Arcanesoft\Foundation\Authorization\Models\Presenters\SessionPresenter;
use Carbon\Carbon;

/**
 * Class     Session
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  string                      id
 * @property  int                         user_id
 * @property  string                      guard
 * @property  string                      ip_address
 * @property  string                      user_agent
 * @property  string                      payload
 * @property  \Illuminate\Support\Carbon  created_at
 * @property  int                         last_activity
 */
class Session extends Model
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use SessionPresenter;

    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const UPDATED_AT = null;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'guard',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'string',
        'last_activity' => 'int',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = SessionEvent::MODEL_EVENTS;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('arcanesoft.auth.database.connection'));
        $this->setTable(Auth::table('sessions'));

        parent::__construct($attributes);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the session is expired.
     *
     * @return bool
     */
    public function hasExpired(): bool
    {
        $expiredAt = Carbon::now()->subMinutes(
            (int) config('session.lifetime')
        );

        return $this->last_activity_at->lessThan($expiredAt);
    }

    /**
     * Check if it has an authenticated user.
     *
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return ! $this->isVisitor();
    }

    /**
     * Check if this is a visitor session.
     *
     * @return bool
     */
    public function isVisitor(): bool
    {
        return is_null($this->user_id);
    }

    /**
     * Check if this is the current used session.
     *
     * @return bool
     */
    public function isCurrent(): bool
    {
        return $this->id === session()->getId();
    }

    /**
     * Check if the given user is the same in the session.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|\Arcanesoft\Foundation\Authorization\Models\User|mixed  $user
     *
     * @return bool
     */
    public function isSameUser($user): bool
    {
        return $this->user_id === $user->getAuthIdentifier()
            && $this->guard === $user->guardName();
    }
}
