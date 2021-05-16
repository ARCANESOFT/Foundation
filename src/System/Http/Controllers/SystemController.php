<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Controllers;

use Arcanesoft\Foundation\System\Policies\InformationPolicy;

/**
 * Class     SystemController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SystemController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SystemController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('foundation::system.info');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(InformationPolicy::ability('index'));

        $this->addBreadcrumb(__('System Information'));

        return $this->view('system.index');
    }
}
