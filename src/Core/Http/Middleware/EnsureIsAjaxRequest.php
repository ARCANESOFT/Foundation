<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Closure;
use Illuminate\Http\{Request, Response};

/**
 * Class     EnsureIsAjaxRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EnsureIsAjaxRequest
{
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
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        abort_unless($request->ajax(), Response::HTTP_BAD_REQUEST, 'Bad Request');

        return $next($request);
    }
}
