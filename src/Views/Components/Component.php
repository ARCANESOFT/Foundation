<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component as IlluminateComponent;

/**
 * Class     Component
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Component extends IlluminateComponent
{
    /* -----------------------------------------------------------------
     |  Common Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string                                         $view
     * @param  \Illuminate\Contracts\Support\Arrayable|array  $data
     * @param  array                                          $mergeData
     *
     * @return \Illuminate\Contracts\View\View
     */
    protected function view(string $view, $data = [], array $mergeData = []): View
    {
        return view()->make("foundation::_components.{$view}", $data, $mergeData);
    }
}
