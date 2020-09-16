<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Database\Factories;

use Arcanesoft\Foundation\Auth\Models\Administrator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class     AdministratorFactory
 *
 * @package  Arcanesoft\Foundation\Auth\Models\Factories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdministratorFactory extends Factory
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
    protected $model = Administrator::class;

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
            'uuid'           => Str::uuid(),
            'first_name'     => $this->faker->firstName,
            'last_name'      => $this->faker->lastName,
            'email'          => $this->faker->unique()->safeEmail,
            'password'       => 'password',
            'remember_token' => Str::random(10),
        ];
    }
}
