<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Controllers;

/**
 * Class     DashboardController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->setCurrentSidebarItem('foundation::authorization.dashboard');
        $this->addBreadcrumbParent();

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.authorization.dashboard.index');

        return $this->view('authorization.dashboard');
    }
}
