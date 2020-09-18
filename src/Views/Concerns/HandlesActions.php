<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Concerns;

use Illuminate\Support\Str;

/**
 * Trait     HandlesActions
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HandlesActions
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Execute component's actions.
     *
     * @param  array  $actions
     */
    private function handleComponentActions(array $actions): void
    {
        foreach ($actions as $action) {
            $type    = $action['type'];
            $payload = $action['payload'];

            if ($type === 'method') {
                $this->handleMethodAction($payload['method'], $payload['params']);
            }
            elseif ($type === 'model') {
                $this->handleModelAction($payload['name'], $payload['value']);
            }
        }
    }

    /**
     * Handle `method` action.
     *
     * @param  string  $method
     * @param  array   $params
     */
    private function handleMethodAction(string $method, array $params)
    {
        $this->{$method}(...$params);
    }

    /**
     * Handle `model` action.
     *
     * @param  string  $property
     * @param  mixed   $value
     */
    private function handleModelAction(string $property, $value)
    {
        $method = 'updating'.Str::studly($property);

        if (method_exists($this, $method))
            $this->$method();

        $this->{$property} = $value;
    }
}
