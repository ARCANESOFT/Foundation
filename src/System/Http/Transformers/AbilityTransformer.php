<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Http\Request;

/**
 * Class     AbilityTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AbilityTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  \Arcanedev\LaravelPolicies\Ability|mixed  $resource
     * @param  \Illuminate\Http\Request                  $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        return [
            'key'         => $resource->key(),
            'name'        => $resource->meta('name', ''),
            'description' => $resource->meta('description', ''),
            'registered'  => with($resource->meta('is_registered', false), function ($isRegistered) {
                return [
                    'type'  => $isRegistered ? 'success' : 'secondary',
                    'label' => __($isRegistered ? 'Yes' : 'No'),
                ];
            }),
        ];
    }
}
