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
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentPage('foundation-home');
        $this->addBreadcrumbRoute(trans('foundation::dashboard.titles.dashboard'), 'admin::foundation.home');
    }

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
        $this->setTitle(trans('foundation::dashboard.titles.dashboard'));

        return $this->view('admin.dashboard');
    }
}
