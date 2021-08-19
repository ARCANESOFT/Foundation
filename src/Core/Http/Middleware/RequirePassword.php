<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Arcanesoft\Foundation\Authentication\Http\Routes\ConfirmPasswordRoutes;
use Arcanesoft\Foundation\Fortify\Http\Middleware\RequirePassword as Middleware;
use Illuminate\Http\Request;

/**
 * Class     RequirePassword
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RequirePassword extends Middleware
{
    /**
     * Get the redirect URL.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null               $redirectToRoute
     *
     * @return string
     */
    protected function getRedirectUrl(Request $request, ?string $redirectToRoute): string
    {
        return route($redirectToRoute ?? ConfirmPasswordRoutes::CREATE);
    }
}
