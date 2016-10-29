<?php namespace Arcanesoft\Foundation\Http\Controllers\System;

use Arcanesoft\Foundation\Http\Controllers\Controller;

/**
 * Class     RoutesController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoutesController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentPage('foundation-system-routes');
        $this->addBreadcrumbRoute('System', 'foundation::system.routes.index');
    }

    public function index()
    {
        $this->setTitle('Routes Viewer');
        $this->addBreadcrumb('Routes');

        $routes = app('arcanedev.foundation.routes-viewer')->all();

        return $this->view('system.routes.list', compact('routes'));
    }
}
