<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

use Arcanesoft\Foundation\Auth\Policies\PasswordResetsPolicy;
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

        $this->setCurrentSidebarItem('auth::authorization.password-resets');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Password Resets'), 'admin::auth.password-resets.index');
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

        $this->addBreadcrumbRoute(__('Metrics'), 'admin::auth.password-resets.metrics');

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.authorization.password-resets');

        return $this->view('authorization.password-resets.metrics');
    }
}
