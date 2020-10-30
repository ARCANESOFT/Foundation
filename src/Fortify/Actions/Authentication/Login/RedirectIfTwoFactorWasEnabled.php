<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Actions\Authentication\Login;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Authorization\Models\Concerns\HasTwoFactorAuthentication;
use Arcanesoft\Foundation\Fortify\Concerns\HasGuard;
use Arcanesoft\Foundation\Fortify\LoginRateLimiter;
use Closure;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Class     RedirectIfTwoFactorWasEnabled
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RedirectIfTwoFactorWasEnabled
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasGuard;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The login rate limiter instance.
     *
     * @var \Arcanesoft\Foundation\Fortify\LoginRateLimiter
     */
    protected $limiter;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * RedirectIfTwoFactorWasEnabled constructor.
     *
     * @param  \Arcanesoft\Foundation\Fortify\LoginRateLimiter  $limiter
     */
    public function __construct(LoginRateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $this->validateCredentials($request);

        if ($this->shouldUseTwoFactor($user)) {
            return $this->twoFactorChallengeResponse($request, $user);
        }

        return $next($request);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if it should use the two factor feature.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool
     */
    protected function shouldUseTwoFactor($user): bool
    {
        if ( ! Auth::isTwoFactorEnabled())
            return false;

        return optional($user)->isTwoFactorEnabled()
            && in_array(HasTwoFactorAuthentication::class, class_uses_recursive($user));
    }

    /**
     * Attempt to validate the incoming credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    protected function validateCredentials(Request $request)
    {
        $model    = $this->guard()->getProvider()->getModel();
        $username = Auth::username();
        $user     = $model::where($username, $request->{$username})->first();

        if ( ! $user || ! Hash::check($request->input('password'), $user->password)) {
            $this->throwFailedAuthenticationException($request);
        }

        return $user;
    }

    /**
     * Get the two factor authentication enabled response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $user
     *
     * @return \Symfony\Component\HttpFoundation\Response|mixed
     */
    protected function twoFactorChallengeResponse(Request $request, $user)
    {
        $request->session()->put([
            'login.id'       => $user->getKey(),
            'login.remember' => $request->filled('remember')
        ]);

        if ($request->wantsJson())
            return new JsonResponse(['two_factor' => true]);

        return redirect()->to($this->getTwoFactorUrl($request));
    }

    /**
     * Throw a failed authentication validation exception.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function throwFailedAuthenticationException(Request $request): void
    {
        $this->limiter->increment($request);

        throw ValidationException::withMessages([
            Auth::username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the two factor redirect url.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    abstract protected function getTwoFactorUrl(Request $request);
}
