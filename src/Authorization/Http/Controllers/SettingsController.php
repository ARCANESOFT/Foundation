<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Authorization\Http\Controllers;

use Arcanesoft\Foundation\Authorization\Policies\SettingsPolicy;
use Arcanesoft\Foundation\Authorization\Repositories\SettingsRepository;
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

        $this->setCurrentSidebarItem('foundation::authorization.settings');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Settings'), 'admin::authorization.settings.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * List all the settings.
     *
     * @param  \Arcanesoft\Foundation\Authorization\Repositories\SettingsRepository  $repo
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
