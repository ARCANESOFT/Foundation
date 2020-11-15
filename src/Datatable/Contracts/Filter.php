<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Datatable\Contracts;

use Illuminate\Contracts\Support\{Arrayable, Jsonable};
use JsonSerializable;

/**
 * Interface  Filter
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Filter extends Arrayable, JsonSerializable, Jsonable
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the filter's type.
     *
     * @return mixed
     */
    public function type(): string;
}
