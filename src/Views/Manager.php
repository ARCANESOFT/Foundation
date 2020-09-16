<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views;

use Arcanesoft\Foundation\Views\Contracts\Manager as ManagerContract;
use Arcanesoft\Foundation\Views\Exceptions\ComponentNotFound;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

/**
 * Class     Manager
 *
 * @package  Arcanesoft\Foundation\Views
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Manager implements ManagerContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    protected $app;

    protected $components = [];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Manager constructor.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register components.
     *
     * @param  string|array  $name
     * @param  string|null   $component
     */
    public function register($name, string $component= null): void
    {
        if (is_array($name)) {
            foreach ($name as $key => $class) {
                $this->register($key, $class);
            }

            return;
        }

        $this->components[$name] = $component;
    }

    /**
     * Check if a component is registered.
     *
     * @param  string  $name
     *
     * @return bool
     */
    public function hasComponent(string $name): bool
    {
        return isset($this->components[$name]);
    }

    /**
     * Make a component.
     *
     * @param string $name
     *
     * @return \Arcanedev\Components\Component
     *
     * @throws \Arcanedev\Components\Exceptions\ComponentNotFound
     */
    public function make(string $name): Component
    {
        if ( ! $this->hasComponent($name))
            throw ComponentNotFound::make($name);

        return $this->app->make($this->components[$name]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Arcanedev\Components\Component
     */
    public function resolve(Request $request): Component
    {
        return $this->make($request->input('component.name'));
    }
}
