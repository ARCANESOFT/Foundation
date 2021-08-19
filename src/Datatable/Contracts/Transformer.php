<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable\Contracts;

use Illuminate\Http\Request;

/**
 * Interface  Transformer
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Transformer
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
    public function transform($resource, Request $request): array;
}
