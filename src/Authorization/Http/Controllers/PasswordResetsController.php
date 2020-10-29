<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Controllers;

use Arcanesoft\Foundation\Authorization\Policies\PasswordResetsPolicy;
use Arcanesoft\Foundation\Support\Traits\HasNotifications;

/**
 * Class     PasswordResetsController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasNotifications;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('foundation::authorization.password-resets');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Password Resets'), 'admin::authorization.password-resets.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(PasswordResetsPolicy::ability('index'));

        return $this->view('authorization.password-resets.index');
    }

    public function metrics()
    {
        $this->authorize(PasswordResetsPolicy::ability('metrics'));

        $this->addBreadcrumbRoute(__('Metrics'), 'admin::authorization.password-resets.metrics');

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.authorization.password-resets');

        return $this->view('authorization.password-resets.metrics');
    }
}
