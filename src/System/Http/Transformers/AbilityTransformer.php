<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Arcanesoft\Foundation\Datatable\DataTypes\Status;
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
     * Transform the resource.
     *
     * @param  \Arcanedev\LaravelPolicies\Ability|mixed  $resource
     * @param  \Illuminate\Http\Request                  $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        $isRegistered = $resource->meta('is_registered', false);

        return [
            'key'         => $resource->key(),
            'name'        => $resource->meta('name', ''),
            'description' => $resource->meta('description', ''),
            'registered'  => (new Status)->transform($isRegistered ? 'success' : 'secondary', $isRegistered ? 'Yes' : 'No'),
        ];
    }
}
