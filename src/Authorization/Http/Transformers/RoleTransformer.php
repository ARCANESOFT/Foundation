<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Transformers;

use Arcanesoft\Foundation\Authorization\Models\Role;
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
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
        return [
            'name'           => $resource->name,
            'description'    => $resource->description,
            'administrators' => $resource->administrators_count,
            'locked'         => $this->lockedBadge($resource),
            'status'         => with($resource->isActive(), function ($isActive) {
                return [
                    'active' => $isActive,
                    'label'  => __($isActive ? 'Activated' : 'Deactivated'),
                    'icon'   => true,
                ];
            }),
            'created_at'     => $resource->created_at->format('Y-m-d H:i:s'),
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the locked badge.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Role  $role
     *
     * @return string
     */
    protected function lockedBadge(Role $role): string
    {
        return '<span class="status '.($role->isLocked() ? 'bg-danger' : 'bg-secondary').'" data-toggle="tooltip" title="'.__($role->isLocked() ? 'Locked' : 'Unlocked').'"></span>';
    }
}
