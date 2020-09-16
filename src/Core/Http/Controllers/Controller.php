<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Controllers;

use Arcanesoft\Foundation\Support\Http\Controller as BaseController;

/**
 * Class     Controller
 *
 * @package  Arcanesoft\Foundation\Core\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Controller extends BaseController
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The view namespace.
     *
     * @var string
     */
    protected $viewNamespace = 'foundation';
}
