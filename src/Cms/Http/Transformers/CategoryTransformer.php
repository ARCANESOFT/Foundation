<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Arcanesoft\Foundation\Datatable\DataTypes\BadgeCount;
use Illuminate\Http\Request;

/**
 * Class     CategoryTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CategoryTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the resource.
     *
     * @param  \Arcanesoft\Foundation\Cms\Models\Category|mixed  $resource
     * @param  \Illuminate\Http\Request                          $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        return [
            'name'        => $resource->name,
            'description' => $resource->description,
            'children'    => (new BadgeCount)->transform($resource->getAttribute('children_count')),
            'created_at'  => $resource->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
