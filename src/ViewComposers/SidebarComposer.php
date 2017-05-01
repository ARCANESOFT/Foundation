<?php namespace Arcanesoft\Foundation\ViewComposers;

use Arcanesoft\Sidebar\Contracts\Manager as SidebarManager;
use Illuminate\Support\Arr;
use Illuminate\View\View;

/**
 * Class     SidebarComposer
 *
 * @package  Arcanesoft\Foundation\ViewComposers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SidebarComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VIEW = 'foundation::admin._template.sidebar-main';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The Sidebar instance.
     *
     * @var \Arcanesoft\Sidebar\Contracts\Manager
     */
    protected $sidebar;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */

    /**
     * SidebarComposer constructor.
     *
     * @param  \Arcanesoft\Sidebar\Contracts\Manager  $sidebar
     */
    public function __construct(SidebarManager $sidebar)
    {
        $this->sidebar = $sidebar;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     */
    public function compose(View $view)
    {
        $this->sidebar->loadItemsFromConfig('arcanesoft.foundation.sidebar.items');
        $this->sidebar->setCurrent(
            Arr::get($view->getData(), 'current_page', '')
        );
    }
}
