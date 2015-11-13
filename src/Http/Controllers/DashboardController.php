<?php namespace Arcanesoft\Foundation\Http\Controllers;

use Arcanesoft\Foundation\Bases\Controller;

/**
 * Class     DashboardController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardController extends Controller
{
    /**
     * Show the foundation dashboard.
     *
     * @return string
     */
    public function index()
    {
        return 'Foundation Dashboard';
    }
}
