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
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Controller constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->addBreadcrumbRoute('System', 'admin::foundation.system.information.index');
    }
}
