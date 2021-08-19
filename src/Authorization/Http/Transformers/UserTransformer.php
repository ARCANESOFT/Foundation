<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Arcanesoft\Foundation\Datatable\DataTypes\Avatar;
use Arcanesoft\Foundation\Datatable\DataTypes\BadgeActive;
use Illuminate\Http\Request;

/**
 * Class     UserTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UserTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the resource.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\User|mixed  $resource
     * @param  \Illuminate\Http\Request                                $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        return [
            'avatar'     => (new Avatar)->transform($resource->avatar, $resource->full_name),
            'first_name' => $resource->first_name,
            'last_name'  => $resource->last_name,
            'email'      => $resource->email,
            'created_at' => $resource->created_at->format('Y-m-d H:i:s'),
            'status'     => (new BadgeActive)->transform($resource->isActive()),
        ];
    }
}
