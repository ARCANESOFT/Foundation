<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
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
            'methods'    => array_map(function (array $method) {
                return [
                    'color' => $method['color'],
                    'label' => $method['name'],
                ];
            }, $resource->methods),
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
            'middleware' => array_map(function (string $middleware) {
                return [
                    'color' => 'dark',
                    'label' => $middleware,
                ];
            }, $resource->middleware),
        ];
    }
}
