<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

use Arcanesoft\Foundation\Auth\Policies\SettingsPolicy;
use Arcanesoft\Foundation\Auth\Repositories\SettingsRepository;
use Arcanesoft\Foundation\Support\Traits\HasNotifications;

/**
 * Class     SettingsController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SettingsController extends Controller
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

        $this->setCurrentSidebarItem('auth::authorization.settings');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Settings'), 'admin::auth.settings.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * List all the settings.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(SettingsRepository $repo)
    {
        $this->authorize(SettingsPolicy::ability('index'));

        $authentication = $repo->getAuthenticationSettings();

        return $this->view('authorization.settings.index', compact('authentication'));
    }
}
