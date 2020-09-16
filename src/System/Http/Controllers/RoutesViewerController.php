<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Controllers;

use Arcanedev\RouteViewer\Contracts\RouteViewer;

/**
 * Class     RoutesViewerController
 *
 * @package  Arcanesoft\Foundation\System\Http\Controllers
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

    public function index()
    {
        return $this->view('system.routes-viewer.index');
    }
}
