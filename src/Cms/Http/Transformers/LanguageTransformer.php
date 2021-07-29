<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Http\Request;

/**
 * Class     LanguageTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LanguageTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the resource.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Language|mixed  $resource
     * @param  \Illuminate\Http\Request                          $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        return [
            // TODO: Add flag image
            'code'        => $resource->code,
            'name'        => $resource->name,
            // TODO: Add active static badge
            'created_at'  => $resource->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
