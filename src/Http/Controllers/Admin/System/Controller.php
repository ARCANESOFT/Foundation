<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin\System;

use Arcanesoft\Foundation\Http\Controllers\Admin\Controller as BaseController;

/**
 * Class     Controller
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\Admin\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Controller extends BaseController
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->addBreadcrumbRoute(trans('foundation::sidebar.system'), 'admin::foundation.system.information.index');
    }
}
