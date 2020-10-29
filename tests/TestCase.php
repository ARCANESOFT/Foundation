<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Tests;

use Arcanesoft\Foundation\Authentication\Guard;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

/**
 * Class     TestCase
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends OrchestraTestCase
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            // Dependencies
            \Arcanedev\LaravelImpersonator\ImpersonatorServiceProvider::class,
            \Arcanedev\LaravelPolicies\PoliciesServiceProvider::class,
            \Arcanedev\LaravelMetrics\MetricServiceProvider::class,
            \Arcanedev\Notify\NotifyServiceProvider::class,

            // Main Provider
            \Arcanesoft\Foundation\FoundationServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        // Configuration
        $app['config']->set(
            'arcanesoft.foundation.auth.database.models.user',
            \Arcanesoft\Foundation\Authorization\Models\User::class
        );

        static::setupAuthConfig($app['config']);
        static::setupPublicRoutes($app['router']);
    }

    /**
     * Setup the auth guards.
     *
     * @param  \Illuminate\Contracts\Config\Repository  $config
     */
    private static function setupAuthConfig($config): void
    {
        $config->set('auth.guards', [
            Guard::WEB_USER => [
                'driver'   => 'session',
                'provider' => 'users',
            ],

            Guard::WEB_ADMINISTRATOR => [
                'driver'   => 'session',
                'provider' => 'administrators',
            ],
        ]);

        $config->set('auth.providers', [
            'users' => [
                'driver' => 'eloquent',
                'model'  => \Arcanesoft\Foundation\Authorization\Models\User::class,
            ],

            'administrators' => [
                'driver' => 'eloquent',
                'model'  => \Arcanesoft\Foundation\Authorization\Models\Administrator::class,
            ],
        ]);
    }

    /**
     * Register public routes.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    private static function setupPublicRoutes($router): void
    {
        $router->get('/', function () {
            return 'index page';
        })->name('public::index');

        $router->get('/home', function () {
            return 'home page';
        })->name('public::home');
    }

    /**
     * Load the migrations.
     */
    protected function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
