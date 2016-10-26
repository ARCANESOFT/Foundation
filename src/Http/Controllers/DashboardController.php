<?php namespace Arcanesoft\Foundation\Http\Controllers;

/**
 * Class     DashboardController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardController extends Controller
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Show the foundation dashboard.
     *
     * @return string
     */
    public function index()
    {
        $this->setCurrentPage('foundation-home');
        $title = 'Dashboard';
        $this->setTitle($title);
        $this->addBreadcrumb($title);

        return $this->view('dashboard');
    }
}
