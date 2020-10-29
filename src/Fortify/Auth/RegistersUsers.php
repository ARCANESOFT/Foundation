<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Auth;

use Arcanesoft\Foundation\Authorization\Auth;
use Arcanesoft\Foundation\Fortify\Concerns\HasGuard;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\{Request, Response};

/**
 * Trait     RegistersUsers
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait RegistersUsers
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasGuard;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array                     $data
     *
     * @return mixed
     */
    protected function register(Request $request, array $data)
    {
        $user = $this->createUser($data);

        event(new Registered($user));

        if ($this->shouldLoginUser($request, $user)) {
            $this->guard()->login($user);
        }

        return $this->getRegisteredResponse($request, $user);
    }

    /**
     * Create a new user.
     *
     * @param  array  $data
     *
     * @return mixed
     */
    abstract protected function createUser(array $data);

    /**
     * Determine if the registered user should be logged in.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $user
     *
     * @return bool
     */
    protected function shouldLoginUser(Request $request, $user): bool
    {
        return Auth::isLoginEnabled();
    }

    /**
     * Get the registered response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $user
     *
     * @return mixed
     */
    protected function getRegisteredResponse(Request $request, $user)
    {
        if ($request->wantsJson())
            new Response('', Response::HTTP_CREATED);

        return redirect()->to($this->redirectUrlAfterRegister($request, $user));
    }

    /**
     * Get the redirect url after user was registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $user
     *
     * @return string
     */
    abstract protected function redirectUrlAfterRegister(Request $request, $user): string;
}
