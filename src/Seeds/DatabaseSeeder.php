<?php namespace Arcanesoft\Foundation\Seeds;

/**
 * Class     DatabaseSeeder
 *
 * @package  Arcanesoft\Foundation\Seeds
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DatabaseSeeder extends AbstractSeeder
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Seeders collection.
     *
     * @var array
     */
    protected $seeds = [
        PermissionsTableSeeder::class,
        RolesTableSeeder::class,
    ];
}
