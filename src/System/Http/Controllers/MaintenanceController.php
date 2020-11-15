<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Controllers;

use Arcanesoft\Foundation\System\Helpers\MaintenanceMode;
use Arcanesoft\Foundation\System\Http\Requests\MaintenanceMode\StartMaintenanceModeRequest;
use Arcanesoft\Foundation\System\Policies\MaintenancePolicy;

/**
 * Class     MaintenanceController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MaintenanceController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('foundation::system.info');
        $this->addBreadcrumbRoute(__('Maintenance'), 'admin::system.maintenance.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(MaintenanceMode $maintenance)
    {
        $this->authorize(MaintenancePolicy::ability('index'));

        return $this->view('system.maintenance.index', [
            'maintenance' => $maintenance,
        ]);
    }

    public function start(MaintenanceMode $maintenance, StartMaintenanceModeRequest $request)
    {
        $this->authorize(MaintenancePolicy::ability('toggle'));

        $maintenance->down(
            $request->get('redirect'),
            $request->get('retry'),
            $request->get('secret')
        );

        // TODO: Add notification

        return redirect()->back();
    }

    public function stop(MaintenanceMode $maintenance)
    {
        if ($maintenance->isEnabled()) {
            $maintenance->up();

            // TODO: Add notification
        }

        return redirect()->back();
    }
}
