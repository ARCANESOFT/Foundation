<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Arcanesoft\Foundation\Datatable\DataTypes\Tag;
use Illuminate\Http\Request;

/**
 * Class     RouteTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the resource.
     *
     * @param  \Arcanedev\RouteViewer\Entities\Route  $resource
     * @param  \Illuminate\Http\Request               $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        return [
            'methods'    => $this->transformMethods($resource->methods),
            'domain'     => $resource->domain ?: '-',
            'details'    => [
                [
                    'term'        => __('Name'),
                    'description' => $resource->name ?: '-',
                ],
                [
                    'term'        => __('URI'),
                    'description' => $resource->uri,
                ],
                [
                    'term'        => __('Action'),
                    'description' => $resource->action,
                ],
            ],
            'middleware' => $this->transformMiddleware($resource->middleware),
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the methods.
     *
     * @param  array  $methods
     *
     * @return array
     */
    protected function transformMethods(array $methods): array
    {
        return array_map(function (array $method) {
            return (new Tag)->transform($method['name'], $method['color']);
        }, $methods);
    }

    /**
     * Transform the middlewares.
     *
     * @param  array  $middlewares
     *
     * @return array
     */
    protected function transformMiddleware(array $middlewares): array
    {
        return array_map(function (string $middleware) {
            return (new Tag)->transform($middleware, 'dark');
        }, $middlewares);
    }
}
