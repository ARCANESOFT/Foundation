<?php namespace Arcanesoft\Foundation\ViewComposers;

use Arcanesoft\Core\Helpers\Sidebar\Contracts\Sidebar;
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
        foreach ($this->getSidebarItems() as $sidebarKey) {
            if (config()->has($sidebarKey)) {
                $this->sidebar->add(config($sidebarKey));
            }
        }

        $this->sidebar->setCurrent(
            Arr::get($view->getData(), 'current_page', '')
        );
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get sidebar items.
     *
     * @return array
     */
    private function getSidebarItems()
    {
        return config('arcanesoft.foundation.sidebar.items', []);
    }
}
