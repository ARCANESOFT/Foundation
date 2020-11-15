<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Http\Request;

/**
 * Class     PasswordResetTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the resource.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Models\PasswordReset|mixed  $resource
     * @param  \Illuminate\Http\Request                                         $request
     *
     * @return array
     */
    public function transform($resource, Request $request): array
    {
        return [
            'email'      => $resource->email,
            'created_at' => $resource->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
