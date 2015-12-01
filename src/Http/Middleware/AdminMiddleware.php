<?php namespace Arcanesoft\Foundation\Http\Middleware;

use Arcanesoft\Contracts\Auth\Models\User;
use Closure;
use Illuminate\Http\Request;

/**
 * Class     AdminMiddleware
 *
 * @package  Arcanesoft\Foundation\Http\Middleware
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdminMiddleware
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (is_null($user = $request->user())) {
            abort(404, 'Guest not allowed !');
        }

        if ( ! $this->isAdmin($user)) {
            abort(404, 'User not allowed !');
        }

        return $next($request);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if user is an administrator.
     *
     * @param  User  $user
     *
     * @return bool
     */
    private function isAdmin($user)
    {
        return $user->isAdmin();
    }
}
