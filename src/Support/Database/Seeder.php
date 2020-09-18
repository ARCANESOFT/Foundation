<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Database;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Seeder as IlluminateSeeder;

/**
 * Class     Seeder
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Seeder extends IlluminateSeeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the seeders.
     *
     * @return array
     */
    public function seeders(): array
    {
        return [];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Eloquent::unguard();

        foreach ($this->seeders() as $seed) {
            $this->call($seed);
        }

        Eloquent::reguard();
    }
}
