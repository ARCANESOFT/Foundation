<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable\Concerns;

use Arcanesoft\Foundation\Datatable\Action;
use Illuminate\Http\Request;

/**
 * Trait     HasActions
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasActions
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Define the datatable actions.
     *
     * @param  \Illuminate\Http\Request                   $request
     * @param  \Illuminate\Database\Eloquent\Model|mixed  $resource
     *
     * @return \Arcanesoft\Foundation\Datatable\Action[]
     */
    abstract protected function actions(Request $request, $resource): array;

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the actions for each resource.
     *
     * @param  \Illuminate\Http\Request                   $request
     * @param  \Illuminate\Database\Eloquent\Model|mixed  $resrouce
     *
     * @return array
     */
    protected function transformActions(Request $request, $resrouce): array
    {
        return array_map(function (Action $action) {
            return $action->toArray();
        }, $this->actions($request, $resrouce));
    }
}
