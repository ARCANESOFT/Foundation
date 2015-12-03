<?php namespace Arcanesoft\Foundation\Http\Controllers;

use Arcanesoft\Foundation\Bases\FoundationController;

/**
 * Class     DashboardController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardController extends FoundationController
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
        $this->addBreadcrumb($title);

        return $this->view('dashboard');
    }
}
