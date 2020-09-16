<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views;

use Arcanesoft\Foundation\Views\Concerns\{CanAuthorize, HandlesActions, InteractsWithProperties};
use Illuminate\Contracts\Support\{Arrayable, Responsable};
use Illuminate\Http\{JsonResponse, Request};

/**
 * Class     Component
 *
 * @package  Arcanesoft\Foundation\Views
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @method  bool                                                      authorize()
 * @method  \Illuminate\Contracts\View\Factory|\Illuminate\View\View  render()
 */
abstract class Component implements Arrayable, Responsable
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use InteractsWithProperties,
        CanAuthorize,
        HandlesActions;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = $this->data();

        if (method_exists($this, 'initializeWithPagination'))
            $this->initializeWithPagination();

        /** @var  \Illuminate\View\View  $view */
        $view = app()->call([$this, 'render']);
        $view->with($data);

        $html = $view->render();

        return compact('html', 'data');
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return new JsonResponse(
            $this->resolve($request)->toArray()
        );
    }

    /**
     * Resolve by the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return $this
     */
    public function resolve(Request $request)
    {
        $data = (array) $request->input('component.data');

        $this->hydrate($data);

        if ( ! $this->passesAuthorization()) {
            $this->failedAuthorization();
        }

        $actions = (array) $request->input('actions');

        if ( ! empty($actions))
            $this->handleComponentActions($actions);

        return $this;
    }
}
