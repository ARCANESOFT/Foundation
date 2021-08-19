<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Listeners\Sessions;

use Arcanesoft\Foundation\Authorization\Events\Sessions\SavedSession;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class     UpdateUserLastActivity
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateUserLastActivity
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $guard;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * UpdateUserLastActivity constructor.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the event.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Events\Sessions\SavedSession  $event
     */
    public function handle(SavedSession $event)
    {
        $session = $event->session;

        if ($session->isVisitor())
            return;

        if ( ! $session->isSameUser($authenticated = $this->getAuthenticated()))
            return;

        $authenticated->forceFill([
            'last_activity_at' => $session->last_activity_at,
        ])->save();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the authenticated user.
     *
     * @return \Arcanesoft\Foundation\Authorization\Models\User|\Arcanesoft\Foundation\Authorization\Models\Administrator|mixed|null
     */
    protected function getAuthenticated()
    {
        return $this->guard->user();
    }
}
