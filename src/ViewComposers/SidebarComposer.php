<?php namespace Arcanesoft\Foundation\ViewComposers;

use Arcanesoft\Core\Helpers\Sidebar\Contracts\Sidebar;
use Illuminate\View\View;

/**
 * Class     SidebarComposer
 *
 * @package  Arcanesoft\Foundation\ViewComposers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SidebarComposer
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The Sidebar Helper instance.
     *
     * @var \Arcanesoft\Core\Helpers\Sidebar\Contracts\Sidebar
     */
    protected $sidebar;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * SidebarComposer constructor.
     *
     * @param  \Arcanesoft\Core\Helpers\Sidebar\Contracts\Sidebar  $sidebar
     */
    public function __construct(Sidebar $sidebar)
    {
        $this->sidebar = $sidebar;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     */
    public function compose(View $view)
    {
        $current_page = array_get($view->getData(), 'current_page', '');

        $this->sidebar->add([
            'title'       => 'Dashboard',
            'name'        => 'foundation-home',
            'route'       => 'foundation::home',
            'icon'        => 'fa fa-fw fa-dashboard',
            'roles'       => [],
            'permissions' => [],
        ]);
        $this->sidebar->add([
            'title'       => 'Authorization',
            'name'        => 'auth',
            'icon'        => 'fa fa-fw fa-key',
            'roles'       => [],
            'permissions' => [],
            'children'    => [
                [
                    'title'       => 'Statistics',
                    'name'        => 'auth-dashboard',
                    'route'       => 'auth::foundation.dashboard',
                    'icon'        => 'fa fa-fw fa-bar-chart',
                    'roles'       => [],
                    'permissions' => [],
                ],[
                    'title'       => 'Users',
                    'name'        => 'auth-users',
                    'route'       => 'auth::foundation.users.index',
                    'icon'        => 'fa fa-fw fa-users',
                    'roles'       => [],
                    'permissions' => [],
                ],[
                    'title'       => 'Roles',
                    'name'        => 'auth-roles',
                    'route'       => 'auth::foundation.roles.index',
                    'icon'        => 'fa fa-fw fa-lock',
                    'roles'       => [],
                    'permissions' => [],
                ],[
                    'title'       => 'Permissions',
                    'name'        => 'auth-permissions',
                    'route'       => 'auth::foundation.permissions.index',
                    'icon'        => 'fa fa-fw fa-check-circle',
                    'roles'       => [],
                    'permissions' => [],
                ]
            ],
        ]);
        $this->sidebar->add([
            'title'       => 'Settings',
            'name'        => 'foundation-settings',
            'icon'        => 'fa fa-fw fa-cogs',
            'roles'       => [],
            'permissions' => [],
            'children'    => [
                [
                    'title'       => 'Generals',
                    'name'        => 'foundation-settings-generals',
                    'route'       => 'auth::foundation.dashboard',
                    'icon'        => 'fa fa-fw fa-wrench',
                    'roles'       => [],
                    'permissions' => [],
                ],[
                    'title'       => 'Themes',
                    'name'        => 'foundation-settings-themes',
                    'route'       => 'auth::foundation.dashboard',
                    'icon'        => 'fa fa-fw fa-paint-brush',
                    'roles'       => [],
                    'permissions' => [],
                ],[
                    'title'       => 'Modules',
                    'name'        => 'foundation-settings-modules',
                    'route'       => 'auth::foundation.dashboard',
                    'icon'        => 'fa fa-fw fa-cubes',
                    'roles'       => [],
                    'permissions' => [],
                ],
            ],
        ]);
        $this->sidebar->add([
            'title'       => 'LogViewer',
            'name'        => 'foundation-logviewer',
            'route'       => 'foundation::log-viewer.index',
            'icon'        => 'fa fa-fw fa-book',
            'roles'       => [],
            'permissions' => [],
        ]);

        $this->sidebar->setCurrent($current_page);
    }
}
