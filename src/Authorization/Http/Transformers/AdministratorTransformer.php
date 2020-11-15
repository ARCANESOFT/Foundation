<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Transformers;

use Arcanesoft\Foundation\Authorization\Models\Administrator;
use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Http\Request;

/**
 * Class     AdministratorTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdministratorTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the resource.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator|mixed  $resource
     * @param  \Illuminate\Http\Request                                         $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        return [
            'first_name' => $resource->first_name,
            'last_name'  => $resource->last_name,
            'email'      => $resource->email,
            'created_at' => $resource->created_at->format('Y-m-d H:i:s'),
            'status'     => with($resource->isActive(), function ($isActive) {
                return [
                    'active' => $isActive,
                    'label'  => __($isActive ? 'Activated' : 'Deactivated'),
                    'icon'   => true,
                ];
            }),
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the status badge as html string.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\Administrator  $resource
     *
     * @return string
     */
    public function statusBadge(Administrator $resource): string
    {
        $isActive = $resource->isActive();

        // TODO: Use the laravel blade component
        return '<span class="badge border text-muted '.($isActive ? 'border-success' : 'border-secondary').'" title="'.__($isActive ? 'Activated' : 'Deactivated').'" data-toggle="tooltip">'.
            '<i class="fa fa-fw '.($isActive ? 'fa-check text-success' : 'fa-ban text-secondary').'"></i>'.
        '</span>';
    }
}
