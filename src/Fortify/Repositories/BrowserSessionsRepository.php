<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Repositories;

use Arcanesoft\Foundation\Fortify\Contracts\BrowserSessions\HasBrowserSessions;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

/**
 * Class     BrowserSessionsRepository
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BrowserSessionsRepository
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The authenticated user.
     *
     * @var  mixed
     */
    protected $user;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the sessions relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions(): HasMany
    {
        return $this->user()->sessions();
    }

    /**
     * Get the authenticated user.
     *
     * @return \Arcanesoft\Foundation\Fortify\Contracts\BrowserSessions\HasBrowserSessions|mixed
     */
    public function user(): HasBrowserSessions
    {
        return $this->user;
    }

    /**
     * Set the authenticated user.
     *
     * @param  \Arcanesoft\Foundation\Fortify\Contracts\BrowserSessions\HasBrowserSessions|mixed  $user
     *
     * @return $this
     */
    public function fromUser(HasBrowserSessions $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Set the authenticated user from request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return $this
     */
    public function fromRequest(Request $request)
    {
        return $this->fromUser($request->user());
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get all the sessions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->sessions()
                    ->orderBy('last_activity', 'desc')
                    ->get();
    }

    /**
     * Logout a browser session by the given session id.
     *
     * @param  string  $id
     *
     * @return bool|mixed|null
     */
    public function logoutOne(string $id)
    {
        // TODO: Add the events
        $deleted = $this->sessions()->firstOrFail($id)->delete();

        return $deleted;
    }

    /**
     * Logout all the other browser sessions.
     *
     * @return mixed
     */
    public function logoutOthers()
    {
        // TODO: Add the events
        $deleted = $this->sessions()
            ->where('id', '!=', session()->getId())
            ->delete();

        return $deleted;
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if valid session driver was used.
     *
     * @return bool
     */
    public function isValidDriver(): bool
    {
        return in_array(config('session.driver'), [
            'database',
            'arcanesoft',
        ]);
    }
}
