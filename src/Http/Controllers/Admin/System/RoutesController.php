<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin\System;

/**
 * Class     RoutesController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoutesController extends Controller
{
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * RoutesController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentPage('foundation-system-routes');
        $this->addBreadcrumbRoute('Routes', 'admin::foundation.system.routes.index');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function index()
    {
        $this->setTitle('Routes Viewer');
        $this->addBreadcrumb('List of all routes');

        $routes = app('arcanedev.foundation.routes-viewer')->all();

        return $this->view('admin.system.routes.list', compact('routes'));
    }
}
