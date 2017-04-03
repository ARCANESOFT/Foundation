<?php namespace Arcanesoft\Foundation\Http\Controllers\Admin;

/**
 * Class     DashboardController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\Admin
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Show the foundation dashboard.
     *
     * @return string
     */
    public function index()
    {
        $this->setCurrentPage('foundation-home');
        $this->setTitle($title = 'Dashboard');
        $this->addBreadcrumb($title);

        return $this->view('admin.dashboard');
    }
}
