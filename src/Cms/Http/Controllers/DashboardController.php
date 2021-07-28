<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Cms\Http\Controllers;

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

    /**
     * Show the CMS dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->setCurrentSidebarItem('foundation::cms.dashboard');
        $this->addBreadcrumbParent();

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.cms.dashboard.index');

        return $this->view('cms.dashboard');
    }
}
