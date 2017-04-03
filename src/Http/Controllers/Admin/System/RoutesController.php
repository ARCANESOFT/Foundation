<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin\System;

use Arcanedev\RouteViewer\Contracts\RouteViewer;

/**
 * Class     RoutesController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoutesController extends Controller
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */
    /**
     * The route viewer instance.
     *
     * @var \Arcanedev\RouteViewer\Contracts\RouteViewer
     */
    protected $routeViewer;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */
    /**
     * RoutesController constructor.
     *
     * @param  \Arcanedev\RouteViewer\Contracts\RouteViewer  $routeViewer
     */
    public function __construct(RouteViewer $routeViewer)
    {
        parent::__construct();

        $this->routeViewer = $routeViewer;

        $this->setCurrentPage('foundation-system-routes');
        $this->addBreadcrumbRoute('Routes', 'admin::foundation.system.routes.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    public function index()
    {
        $this->setTitle('Routes Viewer');
        $this->addBreadcrumb('List of all routes');

        $routes = $this->routeViewer->all();

        return $this->view('admin.system.routes.list', compact('routes'));
    }
}
