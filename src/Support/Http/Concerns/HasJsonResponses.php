<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Http\Concerns;

use Illuminate\Http\JsonResponse;

/**
 * Trait     HasJsonResponses
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasJsonResponses
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create a new JSON response instance.
     *
     * @param  array  $data
     * @param  int    $status
     * @param  array  $headers
     * @param  int    $options
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected static function jsonResponse(array $data = [], int $status = 200, array $headers = [], int $options = 0): JsonResponse
    {
        return new JsonResponse($data, $status, $headers, $options);
    }

    /**
     * Create a new JSON response instance with success code.
     *
     * @param  array  $data
     * @param  int    $status
     * @param  array  $headers
     * @param  int    $options
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected static function jsonResponseSuccess(array $data = [], int $status = 200, array $headers = [], int $options = 0): JsonResponse
    {
        $data = array_merge(['code' => 'success'], $data);

        return static::jsonResponse($data, $status, $headers, $options);
    }

    /**
     * Create a new JSON response instance with error code.
     *
     * @param  array  $data
     * @param  int    $status
     * @param  array  $headers
     * @param  int    $options
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected static function jsonResponseError(array $data = [], int $status = 200, array $headers = [], int $options = 0): JsonResponse
    {
        $data = array_merge(['code' => 'error'], $data);

        return static::jsonResponse($data, $status, $headers, $options);
    }
}
