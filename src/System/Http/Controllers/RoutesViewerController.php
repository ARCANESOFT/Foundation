<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Controllers;

use Arcanedev\RouteViewer\Contracts\RouteViewer;
use Arcanesoft\Foundation\System\Http\Datatables\RoutesDatatable;
use Arcanesoft\Foundation\System\Policies\RouteViewerPolicy;

/**
 * Class     RoutesViewerController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoutesViewerController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->addBreadcrumbRoute(__('Routes Viewer'), 'admin::system.routes-viewer.index');
        $this->setCurrentSidebarItem('foundation::system.routes-viewer');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * List all the routes.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->authorize(RouteViewerPolicy::ability('index'));

        return $this->view('system.routes-viewer.index');
    }

    /**
     * Datatable api response.
     *
     * @param  \Arcanesoft\Foundation\System\Http\Datatables\RoutesDatatable  $datatable
     *
     * @return \Arcanesoft\Foundation\System\Http\Datatables\RoutesDatatable
     */
    public function datatable(RoutesDatatable $datatable)
    {
        $this->authorize(RouteViewerPolicy::ability('index'));

        return $datatable;
    }
}
