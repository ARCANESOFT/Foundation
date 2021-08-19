<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Arcanesoft\Foundation\Authentication\Concerns\UseAdministratorGuard;
use Arcanesoft\Foundation\Authorization\Models\Administrator;
use Closure;
use Illuminate\Http\{Request, Response};

/**
 * Class     EnsureIsAdmin
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EnsureIsAdmin
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UseAdministratorGuard;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user($this->getGuardName());

        abort_unless($this->isAdministrator($user), Response::HTTP_FORBIDDEN);

        return $next($request);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the authenticated user is an administrator.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $user
     *
     * @return bool
     */
    private function isAdministrator($user): bool
    {
        return $user instanceof Administrator;
    }
}
