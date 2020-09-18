<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Contracts;

use Arcanesoft\Foundation\Views\Component;
use Illuminate\Http\Request;

/**
 * Interface  Manager
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Manager
{
    /* -----------------------------------------------------------------
     |  Main Method
     | -----------------------------------------------------------------
     */

    /**
     * Register components.
     *
     * @param  string|array  $name
     * @param  string|null   $component
     */
    public function register($name, string $component= null): void;

    /**
     * Check if a component is registered.
     *
     * @param  string  $name
     *
     * @return bool
     */
    public function hasComponent(string $name): bool;

    /**
     * Make a component.
     *
     * @param  string  $name
     *
     * @return \Arcanesoft\Foundation\Views\Component
     */
    public function make(string $name): Component;

    /**
     * Resolve a component.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Arcanesoft\Foundation\Views\Component
     */
    public function resolve(Request $request): Component;
}
