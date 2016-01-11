<?php namespace Arcanesoft\Foundation\Seeds;

use Arcanesoft\Foundation\Bases\Seeder;

/**
 * Class     DatabaseSeeder
 *
 * @package  Arcanesoft\Foundation\Seeds
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DatabaseSeeder extends Seeder
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Seeder collection.
     *
     * @var array
     */
    protected $seeds = [
        PermissionsTableSeeder::class,
        RolesTableSeeder::class,
    ];
}
