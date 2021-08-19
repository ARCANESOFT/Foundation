<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Controllers\Api;

use Arcanedev\LaravelMetrics\Contracts\Manager;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class     MetricsController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetricsController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the request.
     *
     * @param  \Illuminate\Http\Request                     $request
     * @param  \Arcanedev\LaravelMetrics\Contracts\Manager  $manager
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Manager $manager)
    {
        $class  = $request->get('metric');
        $metric = $manager->get($class);

        abort_if(is_null($metric), Response::HTTP_NOT_FOUND, __('Metric not found'));

        if ($metric->authorizedToSee($request))
            return response()->json($metric->resolve($request)->toArray());

        return response()->json([
            'message' => 'Access Not Allowed',
            'metric'  => $class,
        ], Response::HTTP_FORBIDDEN);
    }
}
