<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Http\Request;

/**
 * Class     ResourceTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ResourceTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the resource.
     *
     * @param  \Illuminate\Database\Eloquent\Model|mixed  $resource
     * @param  \Illuminate\Http\Request                   $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        return $resource->toArray();
    }
}
