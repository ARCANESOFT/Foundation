<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Arcanesoft\Foundation\Datatable\DataTypes\BadgeCount;
use Illuminate\Http\Request;

/**
 * Class     PermissionTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the resource.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Permission|mixed  $resource
     * @param  \Illuminate\Http\Request                                      $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        return [
            'group'       => $resource->group->name,
            'category'    => $resource->category,
            'name'        => $resource->name,
            'description' => $resource->description,
            'roles'       => (new BadgeCount)->transform($resource->roles_count, 'Roles'),
        ];
    }
}
