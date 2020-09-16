<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

/**
 * Class     DashboardController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers
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
        $this->setCurrentSidebarItem('auth::authorization.dashboard');
        $this->addBreadcrumbParent();

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.authorization.dashboard.index');

        return $this->view('authorization.dashboard');
    }
}
