<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Controllers\Api;

use Illuminate\Http\Request;

/**
 * Class     EventsController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EventsController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function handle(Request $request)
    {
        $class = $request->get('class');

        event(new $class($request->get('options', [])));

        return response()->json();
    }
}
