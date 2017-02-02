<?php namespace Arcanesoft\Foundation\Tests;

/**
 * Class     RoutesTest
 *
 * @package  Arcanesoft\Foundation\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoutesTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Routes to check.
     *
     * @var array
     */
    protected $routes = [
        'admin::foundation.home',

        'admin::foundation.settings.index',

        'admin::foundation.system.information.index',

        'admin::foundation.system.log-viewer.index',
        'admin::foundation.system.log-viewer.logs.list',
        'admin::foundation.system.log-viewer.logs.show',
        'admin::foundation.system.log-viewer.logs.download',
        'admin::foundation.system.log-viewer.logs.filter',
        'admin::foundation.system.log-viewer.logs.delete',
    ];

    /* ------------------------------------------------------------------------------------------------
     |  Tests
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_register_routes()
    {
        /** @var \Illuminate\Routing\Router $router */
        $router     = $this->app->make('router');
        $registered = $router->getRoutes();

        foreach ($this->routes as $route) {
            $this->assertTrue(
                $registered->hasNamedRoute($route),
                "The route [$route] not found."
            );
        }
    }
}
