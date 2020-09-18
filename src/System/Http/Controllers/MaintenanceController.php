<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Controllers;

use Arcanesoft\Foundation\Helpers\MaintenanceMode;
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
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Helpers\MaintenanceMode */
    private $maintenance;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(MaintenanceMode $maintenance)
    {
        $this->maintenance = $maintenance;

        parent::__construct();

        $this->setCurrentSidebarItem('foundation::system.info');
        $this->addBreadcrumbRoute(__('Maintenance'), 'admin::system.maintenance.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(MaintenancePolicy::ability('index'));

        return $this->view('system.maintenance.index', [
            'maintenance' => $this->maintenance,
        ]);
    }

    public function start(StartMaintenanceModeRequest $request)
    {
        $this->authorize(MaintenancePolicy::ability('toggle'));

        $this->maintenance->down(
            $request->get('redirect'),
            $request->get('retry'),
            $request->get('secret')
        );

        // TODO: Add notification

        return redirect()->back();
    }

    public function stop()
    {
        if ($this->maintenance->isEnabled()) {
            $this->maintenance->up();

            // TODO: Add notification
        }

        return redirect()->back();
    }
}
