<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin;

use Arcanesoft\Core\Http\Controllers\AdminController;
use Arcanesoft\Core\Traits\Notifyable;

/**
 * Class     Controller
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Controller extends AdminController
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */
    use Notifyable;

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
