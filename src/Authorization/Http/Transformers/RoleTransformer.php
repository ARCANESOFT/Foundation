<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Arcanesoft\Foundation\Datatable\DataTypes\{BadgeActive, BadgeCount, Status};
use Illuminate\Http\Request;

/**
 * Class     RoleTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoleTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the resource.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role|mixed  $resource
     * @param  \Illuminate\Http\Request                                $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        $badgeCount = new BadgeCount;

        return [
            'name'           => $resource->name,
            'description'    => $resource->description,
            'administrators' => $badgeCount->transform($resource->administrators_count, 'Administrators'),
            'permissions'    => $badgeCount->transform($resource->permissions_count, 'Administrators'),
            'locked'         => (new Status)->transform($resource->isLocked() ? 'danger' : 'success', $resource->isLocked() ? 'Locked' : 'Unlocked'),
            'status'         => (new BadgeActive)->transform($resource->isActive()),
            'created_at'     => $resource->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
