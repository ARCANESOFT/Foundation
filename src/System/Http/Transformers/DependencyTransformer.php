<?php

namespace Arcanesoft\Foundation\System\Http\Transformers;

use Arcanesoft\Foundation\Datatable\Contracts\Transformer;
use Illuminate\Http\Request;

/**
 * Class     DependencyTransformer
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DependencyTransformer implements Transformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the resource.
     *
     * @param  array                     $package
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function transform($package, Request $request): array
    {
        return [
            'name'        => $package['name'],
            'description' => $package['description'],
            'version'     => $package['version'],
        ];
    }
}
