<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Controllers;

use Arcanesoft\Foundation\Core\Policies\DashboardPolicy;

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
        $this->authorize(DashboardPolicy::ability('index'));

        $this->setCurrentSidebarItem('foundation::dashboard');

        return $this->view('index');
    }
}
