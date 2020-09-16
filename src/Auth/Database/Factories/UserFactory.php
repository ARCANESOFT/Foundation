<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Database\Factories;

use Arcanesoft\Foundation\Auth\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class     UserFactory
 *
 * @package  Arcanesoft\Foundation\Auth\Database\Factories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UserFactory extends Factory
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'uuid'              => Str::uuid(),
            'first_name'        => $this->faker->firstName,
            'last_name'         => $this->faker->lastName,
            'email'             => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password'          => 'password',
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the user is activated.
     *
     * @return \Arcanesoft\Foundation\Auth\Database\Factories\UserFactory
     */
    public function activated(): self
    {
        return $this->state([
            'activated_at' => now(),
        ]);
    }

    /**
     * Indicate that the user is verified.
     *
     * @param  \Illuminate\Support\Carbon|null  $date
     *
     * @return \Arcanesoft\Foundation\Auth\Database\Factories\UserFactory
     */
    public function verified($date = null): self
    {
        if (is_null($date))
            $date = now();

        return $this->state([
            'email_verified_at' => $date === false ? null : $date,
        ]);
    }

    /**
     * Indicate that the user is unverified.
     *
     * @return \Arcanesoft\Foundation\Auth\Database\Factories\UserFactory
     */
    public function unverified(): self
    {
        return $this->verified(false);
    }
}
