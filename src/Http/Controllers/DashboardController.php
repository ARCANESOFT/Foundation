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
    /**
     * Show the foundation dashboard.
     *
     * @return string
     */
    public function index()
    {
        return $this->view('dashboard');
    }
}
