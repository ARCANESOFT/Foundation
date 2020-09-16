<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Events\Socialite\UserRegistered;
use Arcanesoft\Foundation\Auth\Models\User;
use Arcanesoft\Foundation\Auth\Socialite;
use Arcanesoft\Foundation\Auth\Models\SocialiteProvider;
use Illuminate\Http\Response;

/**
 * Class     SocialiteUsersRepository
 *
 * @package  Arcanesoft\Foundation\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SocialiteUsersRepository extends AbstractRepository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model FQN class.
     *
     * @return string
     */
    public static function modelClass(): string
    {
        return Auth::model('socialite-provider', SocialiteProvider::class);
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Find or create user based on the given provider.
     *
     * @param  string  $provider
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User
     */
    public function findOrCreateUser(string $provider)
    {
        $userData = Socialite::user($provider);

        // User email may not provided.
        $email = $userData->getEmail() ?: "{$userData->getId()}@{$provider}.com";

        /** @var  \Arcanesoft\Foundation\Auth\Models\User|null  $user */
        $user = $this->getUsersRepository()
            ->where('email', $email)
            ->first();

        if (is_null($user)) {
            $user = $this->registerNewUser($userData, $email);
        }

        if ($user->hasLinkedAccount($provider)) {
            return $this->updateLinkedAccount($provider, $user, $userData);
        }

        return $this->createLinkedAccount($provider, $user, $userData);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the users repository.
     *
     * @return \Arcanesoft\Foundation\Auth\Repositories\UsersRepository|mixed
     */
    protected function getUsersRepository(): UsersRepository
    {
        return static::makeRepository(UsersRepository::class);
    }

    /**
     * Register a new user.
     *
     * @param  \Laravel\Socialite\Contracts\User|\Laravel\Socialite\One\User|\Laravel\Socialite\Two\User  $userData
     * @param  string                                                                                     $email
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User
     */
    protected function registerNewUser($userData, $email)
    {
        abort_unless(
            Auth::isRegistrationEnabled(),
            Response::HTTP_UNAUTHORIZED,
            __('Registration is currently disabled.')
        );

        $nameParts = static::getNameParts($userData->getName());

        $attributes = [
            'username'    => $userData->getNickname(),
            'first_name'  => $nameParts['first_name'],
            'last_name'   => $nameParts['last_name'],
            'email'       => $email,
            'avatar'      => $userData->getAvatar(),
            'password'    => null,
        ];

        return tap($this->getUsersRepository()->createOne($attributes), function ($user) {
            event(new UserRegistered($user));
        });
    }

    /**
     * @param  string                                                                                     $provider
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed                                              $user
     * @param  \Laravel\Socialite\Contracts\User|\Laravel\Socialite\One\User|\Laravel\Socialite\Two\User  $userData
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User
     */
    private function createLinkedAccount(string $provider, User $user, $userData)
    {
        $account = static::model()->fill([
            'provider_type' => $provider,
            'provider_id'   => $userData->id,
            'token'         => $userData->token,
        ]);

        $user->linkedAccounts()->save($account);

        return $user;
    }

    /**
     * Update the linked account.
     *
     * @param  string                                                                                     $provider
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed                                              $user
     * @param  \Laravel\Socialite\Contracts\User|\Laravel\Socialite\One\User|\Laravel\Socialite\Two\User  $userData
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User
     */
    protected function updateLinkedAccount(string $provider, User $user, $userData)
    {
        $user->linkedAccounts()->where('provider_type', $provider)->update([
            'token' => $userData->token,
        ]);

        $this->getUsersRepository()->updateOne($user, [
            'avatar' => $userData->getAvatar(),
        ]);

        return $user;
    }

    /**
     * Get the user's name (first_name & last_name).
     *
     * @param  string  $name
     *
     * @return array
     */
    protected static function getNameParts(string $name): array
    {
        $parts = array_values(array_filter(explode(' ', $name)));

        if (empty($parts)) {
            return [
                'first_name' => null,
                'last_name'  => null,
            ];
        }

        if (count($parts) === 1) {
            return [
                'first_name' => $parts[0],
                'last_name'  => null,
            ];
        }

        return [
            'first_name' => $parts[0],
            'last_name'  => $parts[1],
        ];
    }
}
